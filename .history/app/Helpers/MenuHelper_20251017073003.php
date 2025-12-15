<?php

namespace App\Helpers;

use App\Models\Menu;

class MenuHelper
{
    public static function render($location, $cssClass = 'menu')
    {
        $menu = Menu::where('location', $location)->with('items.children')->first();
        
        if (!$menu) {
            return '';
        }

        $html = '<ul class="' . $cssClass . '">';
        
        foreach ($menu->items as $item) {
            $html .= self::renderItem($item);
        }
        
        $html .= '</ul>';
        
        return $html;
    }

    protected static function renderItem($item, $level = 0)
    {
        $hasChildren = $item->children->count() > 0;
        $itemClass = $item->css_class;
        
        if ($hasChildren) {
            $itemClass .= ' has-children';
        }

        $html = '<li class="' . trim($itemClass) . '">';
        $html .= '<a href="' . $item->url . '" target="' . $item->target . '">';
        
        if ($item->icon) {
            $html .= '<i class="' . $item->icon . '"></i> ';
        }
        
        $html .= $item->title;
        $html .= '</a>';
        
        if ($hasChildren) {
            $html .= '<ul class="submenu">';
            
            foreach ($item->children as $child) {
                $html .= self::renderItem($child, $level + 1);
            }
            
            $html .= '</ul>';
        }
        
        $html .= '</li>';
        
        return $html;
    }

    public static function getMenu($location)
    {
        return Menu::where('location', $location)->with('items.children')->first();
    }

    public static function getItems($location)
    {
        $menu = self::getMenu($location);
        return $menu ? $menu->items : collect([]);
    }
}

