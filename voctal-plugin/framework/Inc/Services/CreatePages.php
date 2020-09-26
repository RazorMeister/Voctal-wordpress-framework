<?php

namespace VoctalFramework\Inc\Services;


use VoctalFramework\Inc\Classes\MenuPage;
use VoctalFramework\Inc\Classes\SubmenuPage;
use VoctalFramework\Inc\Classes\OptionPage;

class CreatePages extends BaseService
{
    private $menuPages = [];
    private $submenuPages = [];

    private $menuRegistered = false;
    private $submenuRegistered = false;

    /* Singleton needed start */
    protected static $_instance;

    public static function getInstance()
    {
        if (!isset(self::$_instance))
            self::$_instance = new self();

        return self::$_instance;
    }
    /* Singleton needed end */

    public function addMenu($params, $controller = null)
    {
        $this->menuPages[] = new MenuPage($params, $controller);
        $this->registerHook();
    }

    public function addSubmenu($params, $controller = null)
    {
        $this->submenuPages[] = new SubmenuPage($params, $controller);
        $this->registerHook();
    }

    public function addOptions($params, $controller = null)
    {
        $this->submenuPages[] = new OptionPage($params, $controller);
        $this->registerHook();
    }

    private function registerHook()
    {
        if (!$this->menuRegistered && (count($this->menuPages) > 0)) {
            add_action('admin_menu', [$this, 'setMenu']);
            $this->menuRegistered = true;
        }

        if (!$this->submenuRegistered && (count($this->submenuPages) > 0)) {
            add_action('admin_menu', [$this, 'setSubmenu']);
            $this->submenuRegistered = true;
        }
    }

    public function setMenu()
    {
        foreach ($this->menuPages as $single)
            add_menu_page(...$single->getParams());
    }

    public function setSubmenu()
    {
        foreach ($this->submenuPages as $single)
            add_submenu_page(...$single->getParams());
    }
}