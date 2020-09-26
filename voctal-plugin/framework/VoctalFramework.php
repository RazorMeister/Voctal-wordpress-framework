<?php

namespace VoctalFramework;

use VoctalFramework\Inc\AutoLoader;
use VoctalFramework\Inc\PluginBase;
use VoctalFramework\Inc\Resolver;
use VoctalFramework\Inc\Test;

class VoctalFramework
{
    private $voctal_autoLoader;

    private $voctal_dir;


    const MAIN_NAMESPACE = 'VoctalFramework';
    const VERSION = '0.1';

    public function __construct()
    {
        $this->voctal_dir = dirname(__FILE__);
        $this->setVoctalAutoLoader();
    }

    public function setPluginData($data)
    {
       $pluginBase = PluginBase::getInstance();
       $pluginBase->setData($data);
    }

    public function setPluginAutoLoader($basePath, $mainNamespace)
    {
        $pluginBase = PluginBase::getInstance();
        $pluginBase->setAutoLoader($basePath, $mainNamespace);
    }

    public function __call($method, $arguments)
    {
        $resolver = new Resolver($method, $arguments);
    }
    
    private function setVoctalAutoLoader()
    {
        require_once $this->voctal_dir.'/Inc/AutoLoader.php';
        $this->voctal_autoLoader = new AutoLoader($this->voctal_dir, VoctalFramework::MAIN_NAMESPACE);
    }
}