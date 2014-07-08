<?php

session_start();

require_once "init.php";

require_once "controllers/Cv.controller.php";
require_once "controllers/User.controller.php";
require_once "models/User.model.php";

/**
 *
 * This file is always called by AJAX, and it gets a parameter called 'action' that will tell where to send the
 * rest of the information got by POST
 * @author Fernando Castellar
 * @version 1.0
 *
 */


if (isset($_POST["action"])) {  // If exist the parameter action

    switch ($_POST["action"]) { // Depending of its value

        case "login":
            $loginInfo = json_decode($_POST["loginInfo_json"], true);   // Parses the information give to login
            $success = UserController::login($loginInfo);   // And calls the function login of the UserController
            if ($success) echo "ok";    // If authentication was right, returns ok
            else echo "ko";     // If something failed, returns ko
        break;

        case "logout":
            session_destroy();  // For logging out, it just destroys the session
        break;

        case "savePersonalInfo":
            $personalInfo = json_decode($_POST["personalInfo_json"], true);  // To save personal info, parses the info
            UserController::savePersonalInfo($personalInfo);    // and calls the savePersonalInfo method
        break;

        case "addNewExperience":
            $idNewExperience = CvController::addNewExperience();    // To insert a new row in the experience table
        break;

        case "saveExperience":
            $experience = json_decode($_POST["experience_json"], true); // Updates the info of a single experience
            CvController::saveExperience($experience);  // It calls the saveExperience method
        break;

        case "removeExperience":
            CvController::removeExperience($_POST["idExperience"]);     // Calls for deleting the right experience
        break;

        case "addNewEducation":
            $idNewEducation = CvController::addNewEducation();      // To insert a new row in the education table
            break;

        case "saveEducation":
            $education = json_decode($_POST["education_json"], true); // Updates the info of a single education
            CvController::saveEducation($education);    // It calls the saveEducation method
            break;

        case "removeEducation":
            CvController::removeEducation($_POST["idEducation"]);       // Calls for deleting the right education
            break;

    }

}
