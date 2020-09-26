<?php

namespace VoctalFramework\Inc\Classes;

use VoctalFramework\Inc\Classes\Abstracts\Page;

class MenuPage extends Page
{
    protected $pageType = 'menu';

    protected $paramsScheme = [
        'page_title' => 'required',
        'menu_title' => 'required',
        'capability' => 'required',
        'menu_slug' => 'required',
        'function' => '',
        'icon_url' => '',
        'position' => null,
    ];

    protected $params;
    protected $controller;
}