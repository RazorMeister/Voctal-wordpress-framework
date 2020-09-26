<?php

namespace VoctalFramework\Inc\Classes\Abstracts;

abstract class Page
{
    /**
     * Page type menu|submenu|option.
     *
     * @var string
     */
    protected $pageType = '';

    /**
     * Scheme of parameters (parameterKey => required|defaultValye).
     *
     * @var array
     */
    protected $paramsScheme = [];

    /**
     * Store page parameters.
     *
     * @var array
     */
    protected $params = [];

    /**
     * Page controller (optional).
     *
     * @var null
     */
    protected $controller = null;

    /**
     * Page constructor.
     *
     * @param $params
     *
     * @throws \Exception
     */
    public function __construct($params, $controller)
    {
        $this->sanitizeParams($params);

        if (!is_null($controller))
            $this->setController($controller);
    }

    /**
     * Params getter.
     *
     * @return array
     */
    final public function getParams()
    {
        return $this->params;
    }

    /**
     * Page callback function.
     * Create controller object and run specified method.
     */
    final public function runController()
    {
        $controllerParts = explode('@', $this->controller);
        $class = $controllerParts[0];
        $method = $controllerParts[1];

        //ob_start();
        $controllerObject = new $class();
        $controllerObject->$method();

        /*$output = ob_get_clean();

        echo $output;*/
    }

    /**
     * Sanitize page params, check if required are present.
     *
     * @param $array
     *
     * @throws \Exception
     */
    final protected function sanitizeParams($array)
    {
        if (!is_int(array_keys($array)[0])) {
            $toReturn = [];

            foreach ($this->paramsScheme as $key => $value) {
                if (!isset($array[$key])) {
                    if ($value == 'required')
                        throw new \Exception('Param '.$key.' is required');
                    else
                        $toReturn[] = $value;
                } else
                    $toReturn[] = $array[$key];
            }

            $this->params = $toReturn;
        } else
            $this->params = $array;
    }

    /**
     * Set page controller.
     *
     * @param $controller
     */
    final protected function setController($controller)
    {
        $this->controller = $controller;

        $this->overwriteFunction();
    }


    /**
     * Overwrite param 'function' to properly run controller.
     */
    final protected function overwriteFunction()
    {
        $functionPos = 0;

        foreach ($this->paramsScheme as $key => $value) {
            if ($key == 'function')
                break;

            $functionPos++;
        }

        $this->params[$functionPos] = [$this, 'runController'];
    }
}