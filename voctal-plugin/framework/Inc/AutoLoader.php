<?php

namespace VoctalFramework\Inc;

class AutoLoader
{
    private $basePath;
    private $mainNameSpace;

    /**
     * AutoLoader constructor.
     */
    public function __construct($basePath, $mainNamespace)
    {
        $this->basePath = $basePath;
        $this->mainNameSpace = $mainNamespace;
        spl_autoload_register([$this, 'autoLoad']);
    }

    /**
     * AutoLoad classes.
     *
     * @param $className
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function autoLoad($className)
    {
        if (strpos($className, $this->mainNameSpace) !== false) {
            $className = str_replace($this->mainNameSpace.'\\', '', $className);
            $className = str_replace(' ', '-', $className);

            $file = $this->basePath.DIRECTORY_SEPARATOR.str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";

            try {
                if (!file_exists($file))
                    throw new \Exception('Class '.$className.' does not exist');
                else {
                    require_once($file);
                    return true;
                }
            } catch(Exception $e) {
                die($e->getMessage());
            }
        }
    }
}