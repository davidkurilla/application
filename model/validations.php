<?php

require_once('datalayer.php');

function validName($name) {
    if(preg_match('~[0-9]+~', $name)){
        return false;
    }
    return true;
}

function validGithub($link) {
    return filter_var($link, FILTER_VALIDATE_URL) || $link == "";
}

function validExperience($experience) {
    $allowed = array("0-2", "2-4", "4+");

    for ($i = 0; $i < sizeof($allowed); $i++) {
        if($experience == $allowed[$i]) {return true;}
    }
    return false;

}

function validPhone($number){
    if(preg_match("/^[0-9]{10}+$/", $number)) {
        return true;
    } else {
        return false;
    }
}

function validEmail($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validSelectionsJobs($jobs) {

    $validJobs = getSelectionsJobsAndVerticals();

    foreach ($jobs as $job) {
        if(!in_array($job, $validJobs)) {
            return false;
        }
    }
    return true;
}

function validSelectionsVerticals($verticals) {

    $validVerticals = getSelectionsJobsAndVerticals();

    foreach ($verticals as $vertical) {
        if(!in_array($vertical, $validVerticals)) {
            return false;
        }
    }
    return true;
}