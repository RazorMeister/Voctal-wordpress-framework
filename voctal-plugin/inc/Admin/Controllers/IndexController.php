<?php

namespace VoctalPlugin\Admin\Controllers;

use VoctalFramework\Inc\Classes\Abstracts\Controller;

class IndexController extends Controller
{

    public function index()
    {


        return $this->renderView('index');
    }
}