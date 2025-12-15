<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        // Get first user or create one
        $user = User::first();
        
        if (!$user) {
            $this->command->warn('No users found. Run UserSeeder first.');
            return;
        }

        $this->command->info('Seeding sample media...');
        
        // Clean up old media files
        $mediaPath = storage_path('app/public/media');
        if (is_dir($mediaPath)) {
            $this->command->warn('Cleaning up old media files...');
            \File::deleteDirectory($mediaPath);
            $this->command->info('✓ Old media files deleted');
        }
        
        // Create fresh directories using native mkdir
        $largePath = storage_path('app/public/media/large');
        $mediumPath = storage_path('app/public/media/medium');
        $thumbPath = storage_path('app/public/media/thumb');
        
        mkdir($largePath, 0755, true);
        mkdir($mediumPath, 0755, true);
        mkdir($thumbPath, 0755, true);
        
        $this->command->info('✓ Fresh directories created');

        
        // Sample images to download with academic themes
        $sampleImages = [
            ['name' => 'Campus Building', 'keyword' => 'university,campus'],
            ['name' => 'Students Studying', 'keyword' => 'students,studying'],
            ['name' => 'Laboratory', 'keyword' => 'laboratory,science'],
            ['name' => 'Library', 'keyword' => 'library,books'],
            ['name' => 'Graduation Ceremony', 'keyword' => 'graduation,ceremony'],
            ['name' => 'Computer Lab', 'keyword' => 'computer,classroom'],
            ['name' => 'Lecture Hall', 'keyword' => 'lecture,classroom'],
            ['name' => 'Campus Green', 'keyword' => 'campus,garden'],
            ['name' => 'Research Center', 'keyword' => 'research,technology'],
            ['name' => 'Student Activities', 'keyword' => 'students,activity'],
        ];
        
        foreach ($sampleImages as $index => $imageData) {
            try {
                // Download image from Picsum with fixed seed for consistency
                $seed = 1000 + $index; // Fixed seed: 1000-1009
                $imageUrl = "https://picsum.photos/seed/{$seed}/1920/1280";
                $imageContent = @file_get_contents($imageUrl);
                
                if ($imageContent === false) {
                    $this->command->warn("Failed to download: {$imageData['name']}");
                    continue;
                }
                
                // Generate unique filename
                $filename = Str::uuid() . '.jpg';
                
                // Create temp file
                $tempPath = sys_get_temp_dir() . '/' . $filename;
                file_put_contents($tempPath, $imageContent);
                
                // Get original dimensions
                $image = Image::read($tempPath);
                $originalWidth = $image->width();
                $originalHeight = $image->height();
                
                // 1. LARGE - max width 1600px
                $large = Image::read($tempPath)->scale(width: 1600);
                $largePath = storage_path('app/public/media/large/' . $filename);
                $large->save($largePath, quality: 85);
                $largeDimensions = $large->width() . 'x' . $large->height();
                
                // 2. MEDIUM - 16:9 ratio, 800x450
                $medium = Image::read($tempPath)->cover(800, 450);
                $mediumPath = storage_path('app/public/media/medium/' . $filename);
                $medium->save($mediumPath, quality: 80);
                
                // 3. THUMB - 1:1 ratio, 400x400
                $thumb = Image::read($tempPath)->cover(400, 400);
                $thumbPath = storage_path('app/public/media/thumb/' . $filename);
                $thumb->save($thumbPath, quality: 75);
                
                // Delete temp file
                @unlink($tempPath);
                
                // Calculate file size
                $fileSize = filesize($largePath);
                
                // Store dimension info
                $dimensionsData = [
                    'original' => $originalWidth . 'x' . $originalHeight,
                    'large' => $largeDimensions,
                    'medium' => '800x450',
                    'thumb' => '400x400'
                ];
                
                // Save to database
                Media::create([
                    'name' => $imageData['name'],
                    'file_name' => $filename,
                    'mime_type' => 'image/jpeg',
                    'path' => 'media/large/' . $filename,
                    'disk' => 'public',
                    'collection_name' => 'sample_images',
                    'size' => $fileSize,
                    'custom_properties' => json_encode(['seed' => true]),
                    'responsive_images' => json_encode($dimensionsData),
                    'user_id' => $user->id,
                ]);
                
                $this->command->info("✓ Created: {$imageData['name']}");
                
            } catch (\Exception $e) {
                $this->command->error("Failed to create {$imageData['name']}: " . $e->getMessage());
            }
        }
        
        $this->command->info('Media seeding completed!');
    }
}
