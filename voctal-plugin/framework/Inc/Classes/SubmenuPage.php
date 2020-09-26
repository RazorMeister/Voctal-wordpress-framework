<?php

namespace VoctalFramework\Inc\Classes;

use VoctalFramework\Inc\Classes\Abstracts\Page;

class SubmenuPage extends Page
{
    protected $pageType = 'submenu';

    protected $paramsScheme = [
        'parent_slug' => 'required',
        'page_title' => 'required',
        'menu_title' => 'required',
        'capability' => 'required',
        'menu_slug' => 'required',
        'function' => '',
        'position' => null,
    ];

    protected $params;
    protected $controller;
}