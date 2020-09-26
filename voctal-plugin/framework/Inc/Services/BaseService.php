<?php

namespace VoctalFramework\Inc\Services;

use VoctalFramework\Inc\PluginBase;

abstract class BaseService
{
    protected $basePlugin;

    public function __construct()
    {
        $this->basePlugin = PluginBase::getInstance();
    }
}