<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class BackupController extends Controller
{
    public function index()
    {
        $backups = $this->getBackupsList();
        return view('admin.backup.index', compact('backups'));
    }

    public function create(Request $request)
    {
        $type = $request->input('type', 'full'); // full, database, media

        $timestamp = now()->format('Y-m-d_H-i-s');
        $backupName = "backup_{$type}_{$timestamp}";
        $backupPath = storage_path("app/backups/{$backupName}");

        if (!File::exists(storage_path('app/backups'))) {
            File::makeDirectory(storage_path('app/backups'), 0755, true);
        }

        try {
            if ($type === 'database' || $type === 'full') {
                $this->backupDatabase($backupPath);
            }

            if ($type === 'media' || $type === 'full') {
                $this->backupMedia($backupPath);
            }

            // Create zip file
            $zipPath = $backupPath . '.zip';
            $this->createZip($backupPath, $zipPath);

            // Remove temporary directory
            File::deleteDirectory($backupPath);

            return response()->json([
                'success' => true,
                'message' => 'Backup created successfully',
                'backup' => basename($zipPath)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Backup failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function download($backup)
    {
        $path = storage_path("app/backups/{$backup}");

        if (!File::exists($path)) {
            abort(404, 'Backup not found');
        }

        return response()->download($path);
    }

    public function destroy($backup)
    {
        $path = storage_path("app/backups/{$backup}");

        if (File::exists($path)) {
            File::delete($path);
        }

        return response()->json([
            'success' => true,
            'message' => 'Backup deleted successfully'
        ]);
    }

    protected function getBackupsList()
    {
        $backupPath = storage_path('app/backups');

        if (!File::exists($backupPath)) {
            return [];
        }

        $files = File::files($backupPath);
        $backups = [];

        foreach ($files as $file) {
            $backups[] = [
                'name' => $file->getFilename(),
                'size' => $this->formatBytes($file->getSize()),
                'date' => date('Y-m-d H:i:s', $file->getMTime())
            ];
        }

        return collect($backups)->sortByDesc('date')->values()->all();
    }

    protected function backupDatabase($path)
    {
        File::makeDirectory($path, 0755, true);

        $dbPath = database_path('database.sqlite');

        if (File::exists($dbPath)) {
            File::copy($dbPath, $path . '/database.sqlite');
        }
    }

    protected function backupMedia($path)
    {
        $mediaPath = storage_path('app/public/media');

        if (File::exists($mediaPath)) {
            File::copyDirectory($mediaPath, $path . '/media');
        }
    }

    protected function createZip($source, $destination)
    {
        $zip = new ZipArchive();

        if ($zip->open($destination, ZipArchive::CREATE) !== true) {
            throw new \Exception('Cannot create zip file');
        }

        $files = File::allFiles($source);

        foreach ($files as $file) {
            $relativePath = str_replace($source . '/', '', $file->getPathname());
            $zip->addFile($file->getPathname(), $relativePath);
        }

        $zip->close();
    }

    protected function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

