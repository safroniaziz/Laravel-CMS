<?php

// Debug script to check menu structure
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$menu = App\Models\Menu::where('location', 'main')
    ->with(['items' => function($query) {
        $query->whereNull('parent_id')->orderBy('order');
    }, 'items.children' => function($query) {
        $query->orderBy('order');
    }])
    ->first();

echo "=== MENU DEBUG ===\n\n";
echo "Menu: {$menu->name}\n";
echo "Total items (top-level): " . $menu->items->count() . "\n\n";

foreach ($menu->items as $item) {
    echo "ID: {$item->id} | Title: {$item->title} | Parent ID: " . ($item->parent_id ?? 'NULL') . "\n";
    if ($item->children->count() > 0) {
        echo "  Children ({$item->children->count()}):\n";
        foreach ($item->children as $child) {
            echo "    ID: {$child->id} | Title: {$child->title} | Parent ID: {$child->parent_id}\n";
        }
    }
    echo "\n";
}
