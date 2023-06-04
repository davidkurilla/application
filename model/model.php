<?php
require_once('datalayer.php');

/**
 * Thie class is a model that validates data.
 */
class Model
{
    /**
     * Validates name
     * @param string $name the name to be validated
     * @return bool the validation status
     */
    static function validName($name) {
        if(preg_match('~[0-9]+~', $name)){
            return false;
        }
        return true;
    }

    /**
     * Validates github link
     * @param string $link the link to be validated
     * @return bool the validation status
     */
    static function validGithub($link) {
        return filter_var($link, FILTER_VALIDATE_URL) || $link == "";
    }

    /**
     * Validates experience
     * @param string $experience the experience selection
     * @return bool the validation status
     */
    static function validExperience($experience) {
        $allowed = array("0-2", "2-4", "4+");

        for ($i = 0; $i < sizeof($allowed); $i++) {
            if($experience == $allowed[$i]) {return true;}
        }
        return false;

    }

    /**
     * Validates phone number
     * @param string $number the phone number
     * @return bool the validation status
     */
    static function validPhone($number){
        if(preg_match("/^[0-9]{10}+$/", $number)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validates email
     * @param string $email the email to be validated
     * @return mixed the validation status
     */
    static function validEmail($email) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validates selections jobs
     * @param mixed $jobs jobs to validate
     * @return bool the validation status
     */
    static function validSelectionsJobs($jobs) {

        $validJobs = getSelectionsJobsAndVerticals();

        foreach ($jobs as $job) {
            if(!in_array($job, $validJobs)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Validates selections verticals
     * @param mixed $verticals verticals to validate
     * @return bool the validation status
     */
    static function validSelectionsVerticals($verticals) {

        $validVerticals = getSelectionsJobsAndVerticals();

        foreach ($verticals as $vertical) {
            if(!in_array($vertical, $validVerticals)) {
                return false;
            }
        }
        return true;
    }
}