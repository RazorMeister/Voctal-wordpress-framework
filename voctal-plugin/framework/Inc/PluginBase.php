<?php

namespace VoctalFramework\Inc;


class PluginBase
{
    private $pluginData;
    private $autoLoader;

    protected static $_instance;

    private function __construct() {}

    public static function getInstance()
    {
        if (!isset(self::$_instance))
            self::$_instance = new self();

        return self::$_instance;
    }

    public function setData($data)
    {
        $this->pluginData = $data;
    }

    public function setAutoLoader($basePath, $mainNamespace)
    {
        $this->autoLoader = new AutoLoader($basePath, $mainNamespace);
    }

    public function __get($key)
    {
        if (isset($this->pluginData[$key]))
            return $this->pluginData[$key];
        else
            return null;
    }
}