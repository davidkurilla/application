<?php

//Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload.php
require_once('vendor/autoload.php');
require_once('model/validations.php');

//Create instance of Base
$f3 = Base::instance();
$controller = new Controller($f3);

//Define default route
$f3->route('GET /', function() {
    $GLOBALS['controller']->route('views/home.html');
});

//Define info form route
$f3->route('GET|POST /info', function($f3) {

    $GLOBALS['controller']->route('views/info.html');

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
        if(isset($_POST['optin'])) {$f3->set('SESSION.optin', $_POST['optin']);}


        if(Model::validName($fname)) {
            $f3->set('SESSION.fname', $fname);
        } else {
            $f3->set('errors["fname"]', 'invalid first name! Names cannot contain numbers.');
            echo $f3->get('errors["fname"]');
        }
        if(Model::validName($lname)) {
            $f3->set('SESSION.lname', $lname);
        } else {
            $f3->set('errors["lname"]', 'invalid last name! Names cannot contain numbers.');
            echo $f3->get('errors["lname"]');
        }
        if(Model::validEmail($email)) {
            $f3->set('SESSION.email', $email);
        } else {
            $f3->set('errors["email"]', 'invalid email!');
            echo $f3->get('errors["email"]');
        }

        $f3->set('SESSION.state', $state);

        if(Model::validPhone($phone)) {
            $f3->set('SESSION.phone', $phone);
        } else {
            $f3->set('errors["phone"]', 'invalid phone number!');
            echo $f3->get('errors["phone"]');
        }

        if(empty($f3->get("errors"))) {
            if(isset($_POST['optin']))
            {
                $applicant = new Applicant_SubscribedToLists(
                    $fname,
                    $lname,
                    $email,
                    $state,
                    $phone
                );
            } else {
                $applicant = new Applicant(
                    $fname,
                    $lname,
                    $email,
                    $state,
                    $phone
                );
            }
            $f3->set('SESSION.applicant', $applicant);
            $f3->reroute('/experience');
        }
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

        if(Model::validGithub($github)) {
            $f3->set('SESSION.github', $github);
        } else {
            $f3->set('errors["github"]', 'invalid link!');
            echo $f3->get('errors["github"]');
        }

        if(Model::validExperience($years)) {
            $f3->set('SESSION.years', $years);
        } else {
            $f3->set('errors["years"]', 'invalid selection!');
            echo $f3->get('errors["years"]');
        }


        $f3->set('SESSION.relocate', $relocate);

        if(empty($f3->get("errors"))) {

            $f3->get('SESSION.applicant')->setGithub($github);
            $f3->get('SESSION.applicant')->setExperience($years);
            $f3->get('SESSION.applicant')->setRelocate($relocate);
            $f3->get('SESSION.applicant')->setBio($bio);

            if($f3->get('SESSION.optin') === 'true') {
                $f3->reroute('/mailing_lists');
            } else {
                $f3->reroute('/summary');
            }
        }
    }
});

//Define mailing list form route
$f3->route('GET|POST /mailing_lists', function($f3) {

    $GLOBALS['controller']->route('views/mailing_lists.html');

    //Variables
    $mailing = array();

    //Reroute to summary
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['mailing'])) {$mailing = $_POST['mailing'];}

        if(Model::validSelectionsJobs($mailing) && Model::validSelectionsVerticals($mailing)) {
            $f3->set('SESSION.mailing', implode(", ", $mailing));
        } else {
            $f3->set('errors["mailing"]', 'invalid selection(s)!');
            echo $f3->get('errors["mailing"]');
        }

        if(empty($f3->get("errors"))) {
            $f3->get('SESSION.applicant')->setSelectionsJobs($mailing);
            $f3->get('SESSION.applicant')->setSelectionsVerticals($mailing);
            $f3->reroute('/summary');
        }
    }
});

//Define summary form route
$f3->route('GET|POST /summary', function($f3) {
    $GLOBALS['controller']->route('views/summary.html');
});

//Run $f3
$f3->run();