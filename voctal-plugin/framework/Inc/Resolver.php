<?php

namespace VoctalFramework\Inc;

use VoctalFramework\Inc\Services\EnqueueScripts;
use VoctalFramework\Inc\Services\CreatePages;

class Resolver
{
    private $method;
    private $arguments;

    private $scheme = [
        'enqueueGlobalCss' => [EnqueueScripts::class, 'addGlobalCss'],
        'enqueueAdminCss' => [EnqueueScripts::class, 'addAdminCss'],
        'enqueueGlobalJs' => [EnqueueScripts::class, 'addGlobalJs'],
        'enqueueAdminJs' => [EnqueueScripts::class, 'addAdminJs'],
        'addMenuPage' => [CreatePages::class, 'addMenu'],
        'addSubmenuPage' => [CreatePages::class, 'addSubmenu'],
        'addOptionsPage' => [CreatePages::class, 'addOptions'],
    ];

    /**
     * Resolver constructor.
     *
     * @param $method
     * @param $arguments
     */
    public function __construct($method, $arguments)
    {
        $this->method = $method;
        $this->arguments = $arguments;
        $this->resolve();
    }

    /**
     * Resolve method if exists in scheme.
     */
    public function resolve()
    {
        if (array_key_exists($this->method, $this->scheme)) {
            $info = $this->scheme[$this->method];
            $class = $info[0]::getInstance();
            $action = $info[1];
            $class->$action(...$this->arguments);
        }
    }
}