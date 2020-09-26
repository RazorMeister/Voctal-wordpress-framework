<?php

namespace VoctalFramework\Inc\Services;

class EnqueueScripts extends BaseService
{
    /**
     * Css styles.
     */
    private $globalCss = [];
    private $adminCss = [];

    /**
     * JavaScript scripts.
     */
    private $globalJs = [];
    private $adminJs = [];

    /**
     * Added action hooks flags.
     */
    private $globalScriptsRegistered = false;
    private $adminScriptsRegistered = false;

    /* Singleton needed start */
    protected static $_instance;

    public static function getInstance()
    {
        if (!isset(self::$_instance))
            self::$_instance = new self();

        return self::$_instance;
    }
    /* Singleton needed end */

    /**
     * Add global css style.
     *
     * @param $file
     */
    public function addGlobalCss($file)
    {
        $this->globalCss[] = $file;
        $this->registerHook();
    }

    /**
     * Add admin css style.
     *
     * @param $file
     */
    public function addAdminCss($file)
    {
        $this->adminCss[] = $file;
        $this->registerHook();
    }

    /**
     * Add global javascript.
     *
     * @param $file
     */
    public function addGlobalJs($file)
    {
        $this->globalJs[] = $file;
        $this->registerHook();
    }

    /**
     * Add admin javascript.
     *
     * @param $file
     */
    public function addAdminJs($file)
    {
        $this->adminJs[] = $file;
        $this->registerHook();
    }

    /**
     * Check if hook for adding scripts / styles was registered. If not register it.
     */
    private function registerHook()
    {
        if (!$this->globalScriptsRegistered && (count($this->globalCss) > 0 || count($this->globalJs) > 0)) {
            add_action('wp_enqueue_scripts', [$this, 'enqueueGlobal']);
            $this->globalScriptsRegistered = true;
        }

        if (!$this->adminScriptsRegistered && (count($this->adminCss) > 0 || count($this->adminJs) > 0)) {
            add_action('admin_enqueue_scripts', [$this, 'enqueueAdmin']);
            $this->adminScriptsRegistered = true;
        }
    }

    /**
     * Global styles & script hook callback.
     */
    public function enqueueGlobal()
    {
        foreach ($this->globalCss as $file)
            wp_enqueue_style($this->basePlugin->slug.'-'.$file, $this->basePlugin->url.'/'.$this->basePlugin->assets.'/css/'.$file.'.css');

        foreach ($this->globalJs as $file)
            wp_enqueue_script($this->basePlugin->slug.'-'.$file, $this->basePlugin->url.'/'.$this->basePlugin->assets.'/js/'.$file.'.js');
    }

    /**
     * Admin styles & script hook callback.
     */
    public function enqueueAdmin()
    {
        foreach ($this->adminCss as $file)
            wp_enqueue_style($this->basePlugin->slug.'-'.$file, $this->basePlugin->url.'/'.$this->basePlugin->assets.'/css/'.$file.'.css');

        foreach ($this->adminJs as $file)
            wp_enqueue_script($this->basePlugin->slug.'-'.$file, $this->basePlugin->url.'/'.$this->basePlugin->assets.'/js/'.$file.'.js');
    }
}