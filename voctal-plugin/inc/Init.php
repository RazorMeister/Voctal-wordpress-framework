<?php

namespace VoctalPlugin;

class Init
{
    private $voctalFramework;

    public function __construct($voctalFramework)
    {
        $this->voctalFramework = $voctalFramework;
        $this->setStyles();
        $this->setScripts();
        $this->setMenu();
    }

    private function setStyles()
    {
        $this->voctalFramework->enqueueGlobalCss('voctal-global-css');
        $this->voctalFramework->enqueueAdminCss('voctal-admin-css');
    }

    private function setScripts()
    {
        //$this->voctalFramework->enqueueGlobalJs('voctal-global-js');
        //$this->voctalFramework->enqueueAdminJs('voctal-admin-js');
    }

    private function setMenu()
    {
        $this->voctalFramework->addMenuPage([
            'page_title' => 'Voctal plugin home',
            'menu_title' => 'Voctal plugin',
            'capability' => 'manage_options',
            'menu_slug' => 'voctal-plugin',
            //'function' => 'test',
            'icon_url' => 'dashicons-chart-pie',
            'position' => 6
        ], 'VoctalPlugin\Admin\Controllers\IndexController@index');

        /*$this->voctalFramework->addMenu([
            'Voctal plugin home',
            'Voctal plugin',
            'manage_options',
            'voctal-plugin',
            'test_init',
            'dashicons-chart-pie',
            6
        ]);*/

        $this->voctalFramework->addSubmenuPage([
            'parent_slug' => 'voctal-plugin',
            'page_title' => 'Voctal plugin home',
            'menu_title' => 'Voctal plugin Submenu',
            'capability' => 'manage_options',
            'menu_slug' => 'voctal-plugin_2',
            'function' => 'test_init',
            'position' => 1
        ]);

        $this->voctalFramework->addSubmenuPage([
            'voctal-plugin',
            'Voctal plugin home',
            'Voctal plugin Submenu 2',
            'manage_options',
            'voctal-plugin_3',
            'test_init',
            2
        ]);

        $this->voctalFramework->addOptionsPage([
            'page_title' => 'Voctal plugin Options',
            'menu_title' => 'Voctal plugin Options',
            'capability' => 'manage_options',
            'menu_slug' => 'voctal-plugin_options',
            'function' => 'test_init',
        ]);
    }
}