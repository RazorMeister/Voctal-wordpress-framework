<?php

namespace VoctalFramework\Inc\Classes;

use VoctalFramework\Inc\Classes\Abstracts\Page;

class OptionPage extends Page
{
    protected $pageType = 'option';

    protected $paramsScheme = [
        'page_title' => 'required',
        'menu_title' => 'required',
        'capability' => 'required',
        'menu_slug' => 'required',
        'function' => '',
        'position' => null,
    ];

    protected $params;
    protected $controller;

    public function __construct($params, $controller)
    {
        parent::__construct($params, $controller);

        array_unshift($this->params, 'options-general.php');
    }
}