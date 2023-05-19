<?php

//Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload.php
require_once('vendor/autoload.php');

//Create instance of Base
$f3 = Base::instance();

//Define default route
$f3->route('GET /', function() {

    //Create instance of Template
    $view = new Template();

    //Render $view
    echo $view->render('views/home.html');
});

//Run $f3
$f3->run();