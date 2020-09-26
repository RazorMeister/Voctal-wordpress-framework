<?php

namespace VoctalFramework\Inc\Classes\Abstracts;

use VoctalFramework\Inc\PluginBase;

abstract class Controller
{
    protected $basePlugin;

    public function __construct()
    {
        $this->basePlugin = PluginBase::getInstance();
    }

    protected function renderView($file)
    {
        ob_start();

        include_once($this->basePlugin->path.'/'.$this->basePlugin->viewsPath.'/'.$file.'.php');

        $output = ob_get_clean();

        echo $output;
    }
}