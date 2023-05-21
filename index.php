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
$f3->route('GET|POST /info', function($f3) {

    //Create instance of Template
    $view = new Template();

    //Render $view
    echo $view->render('views/info.html');

    //Variables
    $fname = "";
    $lname = "";
    $email = "";
    $state = "";
    $phone = "";

    //Reroute to experience
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['fname'])) {$fname = $_POST['fname'];}
        if(isset($_POST['lname'])) {$lname = $_POST['lname'];}
        if(isset($_POST['email'])) {$email = $_POST['email'];}
        if(isset($_POST['state'])) {$state = $_POST['state'];}
        if(isset($_POST['phone'])) {$phone = $_POST['phone'];}

        $f3->set('SESSION.fname', $fname);
        $f3->set('SESSION.lname', $lname);
        $f3->set('SESSION.email', $email);
        $f3->set('SESSION.state', $state);
        $f3->set('SESSION.phone', $phone);

        $f3->reroute('/experience');
    }

});

//Define experience form route
$f3->route('GET|POST /experience', function($f3) {

    //Create instance of Template
    $view = new Template();

    //Render $view
    echo $view->render('views/experience.html');

    //Variables
    $bio = "";
    $github = "";
    $years = "";
    $relocate = "";

    //Reroute to mailing list
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['bio'])) {$bio = $_POST['bio'];}
        if(isset($_POST['github'])) {$github = $_POST['github'];}
        if(isset($_POST['years'])) {$years = $_POST['years'];}
        if(isset($_POST['relocate'])) {$relocate = $_POST['relocate'];}

        $f3->set('SESSION.bio', $bio);
        $f3->set('SESSION.github', $github);
        $f3->set('SESSION.years', $years);
        $f3->set('SESSION.relocate', $relocate);

        $f3->reroute('/mailing_lists');
    }
});

//Define mailing list form route
$f3->route('GET|POST /mailing_lists', function($f3) {

    //Create instance of Template
    $view = new Template();

    //Render $view
    echo $view->render('views/mailing_lists.html');

    //Variables
    $mailing = array();

    //Reroute to summary
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['mailing'])) {$mailing = $_POST['mailing'];}

        $f3->set('SESSION.mailing', implode(", ", $mailing));

        $f3->reroute('/summary');
    }
});

//Define summary form route
$f3->route('GET|POST /summary', function($f3) {

    //Create instance of Template
    $view = new Template();

    //Render $view
    echo $view->render('views/summary.html');
});

//Run $f3
$f3->run();