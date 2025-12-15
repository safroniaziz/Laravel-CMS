<?php

namespace App\Helpers;

class BreadcrumbHelper
{
    protected $items = [];

    public function add($title, $url = null)
    {
        $this->items[] = [
            'title' => $title,
            'url' => $url
        ];
        
        return $this;
    }

    public function addHome($title = 'Home', $url = '/')
    {
        array_unshift($this->items, [
            'title' => $title,
            'url' => $url
        ]);
        
        return $this;
    }

    public function render($class = 'breadcrumb')
    {
        if (empty($this->items)) {
            return '';
        }

        $html = '<nav aria-label="breadcrumb">';
        $html .= '<ol class="' . $class . '">';
        
        $lastIndex = count($this->items) - 1;
        
        foreach ($this->items as $index => $item) {
            $isLast = $index === $lastIndex;
            $itemClass = $isLast ? 'breadcrumb-item active' : 'breadcrumb-item';
            
            $html .= '<li class="' . $itemClass . '"';
            
            if ($isLast) {
                $html .= ' aria-current="page"';
            }
            
            $html .= '>';
            
            if (!$isLast && $item['url']) {
                $html .= '<a href="' . $item['url'] . '">' . e($item['title']) . '</a>';
            } else {
                $html .= e($item['title']);
            }
            
            $html .= '</li>';
        }
        
        $html .= '</ol>';
        $html .= '</nav>';
        
        return $html;
    }

    public function renderSchema()
    {
        if (empty($this->items)) {
            return '';
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => []
        ];

        foreach ($this->items as $index => $item) {
            $schema['itemListElement'][] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['title'],
                'item' => $item['url'] ? url($item['url']) : null
            ];
        }

        return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';
    }

    public function getItems()
    {
        return $this->items;
    }
}

