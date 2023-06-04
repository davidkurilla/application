<?php

/**
 * This class represents the Controller.
 */
class Controller
{
    private $_f3;

    /**
     * This is the constructor for the class.
     * @param Base $f3 the f3 base
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Route method allows for routing to different pages.
     * @param string $path thet path to the route.
     */
    function route($path)
    {
        //Create instance of Template
        $view = new Template();

        //Render $view
        echo $view->render($path);
    }
}