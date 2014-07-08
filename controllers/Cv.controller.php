<?php

require_once "models/Cv.model.php";
require_once "views/Cv.view.php";
require_once "controllers/User.controller.php";

/**
 *
 * @author Fernando Castellar
 * @description Class CONTROLLER for the management of the CVs. It calls to the view for showing a CV or inserting
 *              the login form, and call to the model for getting or saving info.
 * @version 1.0
 *
 */

class CvController {

    /*
     * @function: showCv
     * @author: Fernando Castellar Mendez
     * @description: It shows a whole CV, calling the functions that shows the three parts of a Cv (personal info,
     *               experience and education), and calling the function that inserts the login button and form.
     * @param: int $idUser User's ID to show.
     * @access: public
     * @version: 1.0
     */
    public static function showCV($idUser) {
        UserController::personalInfo($idUser);    // Calls to the function that shows the personal information
        self::experience($idUser);      // Calls to the function that shows the experience
        self::education($idUser);       // Calls to the function that shows the education
        UserController::insertLogin();          // Calls to the function that inserts the login form and button
    }

    /*
     * @function: experience
     * @author: Fernando Castellar Mendez
     * @description: It gets the experience info from the Model class and shows it with a function from the View class.
     * @param: int $idUser User's ID with the experience to show.
     * @access: public
     * @version: 1.0
     */
    public static function experience($idUser) {
        $experience = CvModel::getExperience($idUser);  // Calls to the Model class to get the user's experience
        CvView::showExperience($experience);            // Calls to the View class to print it in the screen
    }

    /*
     * @function: education
     * @author: Fernando Castellar Mendez
     * @description: It gets the education info from the Model class and shows it with a function from the View class.
     * @param: int $idUser User's ID with the education to show.
     * @access: public
     * @version: 1.0
     */
    public static function education($idUser) {
        $education = CvModel::getEducation($idUser);    // Calls to the Model class to get the user's education
        CvView::showEducation($education);              // Calls to the View class to print it in the screen
    }

    /*
     * @function: addNewExperience
     * @author: Fernando Castellar Mendez
     * @description: This method will be called by Ajax. It calls to the Model class to insert a new row in the table
     *               'experience' and calls to the view to get the view of a new whole row.
     * @return: The view of a new row in the experience table, with empty cells (just ID and remove column filled).
     * @access: public
     * @version: 1.0
     */
    public static function addNewExperience() {
    $currentUser = UserModel::loadCurrentUser();    // Load the current user (the owner of the CV to change)
    $idNewExperience = CvModel::addNewExperience($currentUser->getId());    // Calls to the Model to insert a new row
    return CvView::addNewExperienceRow($idNewExperience);   // Return the view of a new row
}
    /*
     * @function: saveExperience
     * @author: Fernando Castellar Mendez
     * @description: This method calls to the Model to save the information of an experience in the database
     * @param: array $experience Keys and values of the experience to save
     * @access: public
     * @version: 1.0
     */
    public static function saveExperience($experience) {
        $currentUser = UserModel::loadCurrentUser();    // Load the current user (the owner of the CV to update)
        CvModel::saveExperience($currentUser->getId(), $experience);    // Calls to the Model to save the data
    }

    /*
     * @function: removeExperience
     * @author: Fernando Castellar Mendez
     * @description: This method calls to the Model to remove a experience from the database
     * @param: int $idExperience Identifier number of the experience to remove
     * @access: public
     * @version: 1.0
     */
    public static function removeExperience($idExperience) {
        $idUser = UserModel::loadCurrentUser();     // Load the user who logged in (owner of the CV)
        CvModel::removeExperience($idUser->getId(), $idExperience);     // Calls to the Model to remove the experience
    }

    /*
     * @function: addNewEducation
     * @author: Fernando Castellar Mendez
     * @description: This method will be called by Ajax. It calls to the Model class to insert a new row in the table
     *               'education' and calls to the view to get the view of a new whole row.
     * @return: The view of a new row in the education table, with empty cells (just ID and remove column filled).
     * @access: public
     * @version: 1.0
     */
    public static function addNewEducation() {
        $currentUser = UserModel::loadCurrentUser();    // Load the current user (the owner of the CV to change)
        $idNewEducation = CvModel::addNewEducation($currentUser->getId());  // Calls to the Model to insert a new row
        return CvView::addNewEducationRow($idNewEducation);     // Return the view of a new row
    }

    /*
     * @function: saveEducation
     * @author: Fernando Castellar Mendez
     * @description: This method calls to the Model to save the information of an education in the database
     * @param: array $education Keys and values of the education to save
     * @access: public
     * @version: 1.0
     */
    public static function saveEducation($education) {
        $currentUser = UserModel::loadCurrentUser();     // Load the current user (the owner of the CV to update)
        CvModel::saveEducation($currentUser->getId(), $education);  // Calls to the Model to remove the education
    }

    /*
     * @function: removeEducation
     * @author: Fernando Castellar Mendez
     * @description: This method calls to the Model class to remove an education from the database
     * @param: int $idEducation Identifier number of the education to remove
     * @access: public
     * @version: 1.0
     */
    public static function removeEducation($idEducation) {
        $idUser = UserModel::loadCurrentUser();     // Load the user who logged in (owner of the CV)
        CvModel::removeEducation($idUser->getId(), $idEducation);   // Calls to the Model to remove the education
    }
}