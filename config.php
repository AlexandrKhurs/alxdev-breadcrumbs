<?php

// execution context - AlxDevBreadcrumbsPlugin::__construct()
// so $this is available here

$this->home_display_name = 'Главная';
$this->exclude_categories = ['uncategorized'];
$this->post_types_settings = [
    'post' => [
        'top_page_slug' => 'news',
        'use_taxonomy' => 'category'
    ],
    'products' => [
        'top_page_slug' => 'products',
        'use_taxonomy' => 'products-category'
    ],
];
$this->separator = ' / ';
