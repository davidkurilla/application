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

//Define info form route
$f3->route('GET /info', function() {

    //Create instance of Template
    $view = new Template();

    //Render $view
    echo $view->render('views/info.html');
});

//Reroute to experience
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $f3->reroute('/experience');
}

//Define experience form route
$f3->route('GET /experience', function() {

    //Create instance of Template
    $view = new Template();

    //Render $view
    echo $view->render('views/experience.html');
});

//Reroute to mailing list
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $f3->reroute('/mailing_lists');
}

//Define mailing list form route
$f3->route('GET /mailing_lists', function() {

    //Create instance of Template
    $view = new Template();

    //Render $view
    echo $view->render('views/mailing_lists.html');
});

//Reroute to summary
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $f3->reroute('/summary');
}

//Define summary form route
$f3->route('GET /summary', function() {

    //Create instance of Template
    $view = new Template();

    //Render $view
    echo $view->render('views/summary.html');
});

//Run $f3
$f3->run();