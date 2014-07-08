<?php

require_once "libs/db.php";

/*
 * @author Fernando Castellar Mendez
 * @description Class MODEL for communicating the CV features with the database, getting, inserting, saving and
 *              deleting information about the experience and education of the current user's CV
 * @version 1.0
 */
class CvModel {

    /*
     * @function: getExperience
     * @author: Fernando Castellar Mendez
     * @description: It gets the experience from the database
     * @param: int $idUser User's ID with the experience to show.
     * @return: Array with the experience to show
     * @access: public
     * @version: 1.0
     */
    public static function getExperience($idUser) {
        $conditions[0] = array(     // Write the first condition: Compare user's id
            "param1"  => "id_user",
            "operator" => "=",
            "param2" => $idUser);
        $experience = dbSelect("experiences", '*', $conditions, "date_start", "DESC");  // Calls to the select function
        return $experience;
    }

    /*
     * @function: addNewExperience
     * @author: Fernando Castellar Mendez
     * @description: It inserts a new row in the experience table
     * @param: int $idUser User's ID where to insert the new experience
     * @return: ID of the new experience
     * @access: public
     * @version: 1.0
     */
    public static function addNewExperience($idUser) {
        $values["id_user"] = $idUser;   // The only value it will save in the just created experience
        $idNewExperience = dbInsert("experiences", $values);    // Calls to the insert function
        return $idNewExperience;
    }

    /*
     * @function: saveExperience
     * @author: Fernando Castellar Mendez
     * @description: It updates one of the experiences of the experience table in the database
     * @param: int $idUser User's ID owner of the CV where to upload the experience
     *         array $experience Array with the pairs Key/Value containing the information to save
     * @access: public
     * @version: 1.0
     */
    public static function saveExperience($idUser, $experience) {
        $conditions[0] = array(     // First condition: Compare the user's id
            "param1"  => "id_user",
            "operator" => "=",
            "param2" => $idUser);
        $conditions[1] = array(     // Second condition, compare the experience given
            "param1"  => "id_experience",
            "operator" => "=",
            "param2" => array_shift($experience));  // It takes the first value of the array (id) and remove it
        dbUpdate("experiences",$experience,$conditions);    // Calls to the update function
    }

    /*
     * @function: removeExperience
     * @author: Fernando Castellar Mendez
     * @description: It removes a an experience from the CV in the database
     * @param: int $idUser User's ID where to look for the experience to remove
     *         int $idExperience Experience's ID to remove
     * @access: public
     * @version: 1.0
     */
    public static function removeExperience($idUser, $idExperience) {
        $conditions[0] = array(     // First condition: Comparing the user's id
            "param1"  => "id_user",
            "operator" => "=",
            "param2" => $idUser);
        $conditions[1] = array(     // Second condition: Comparing the experience's id
            "param1"  => "id_experience",
            "operator" => "=",
            "param2" => $idExperience);
        dbDelete("experiences", $conditions);   // Calls to the delete function
    }

    /*
     * @function: getEducation
     * @author: Fernando Castellar Mendez
     * @description: It gets the education from the database
     * @param: int $idUser User's ID with the education to show.
     * @return: Array with the education to show
     * @access: public
     * @version: 1.0
     */
    public static function getEducation($idUser) {
        $conditions[0] = array(     // Write the first condition: Compare user's id
            "param1"  => "id_user",
            "operator" => "=",
            "param2" => $idUser);
        $education = dbSelect("educations", '*', $conditions, "date_start", "DESC");    // Calls to the select function
        return $education;
    }

    /*
     * @function: addNewEducation
     * @author: Fernando Castellar Mendez
     * @description: It inserts a new row in the education table
     * @param: int $idUser User's ID where to insert the new education
     * @return: ID of the new education
     * @access: public
     * @version: 1.0
     */
    public static function addNewEducation($idUser) {
        $values["id_user"] = $idUser;   // The only value it will save in the just created education
        $idNewEducation = dbInsert("educations", $values);  // Calls to the insert function
        return $idNewEducation;
    }

    /*
     * @function: saveEducation
     * @author: Fernando Castellar Mendez
     * @description: It updates one of the educations of the education table in the database
     * @param: int $idUser User's ID owner of the CV where to upload the education
     *         array $education Array with the pairs Key/Value containing the information to save
     * @access: public
     * @version: 1.0
     */
    public static function saveEducation($idUser, $education) {
        $conditions[0] = array(     // First condition: Compare the user's id
            "param1"  => "id_user",
            "operator" => "=",
            "param2" => $idUser);
        $conditions[1] = array(     // Second condition, compare the experience given
            "param1"  => "id_education",
            "operator" => "=",
            "param2" => array_shift($education));   // It takes the first value of the array (id) and remove it
        dbUpdate("educations",$education,$conditions);  // Calls to the update function
    }

    /*
     * @function: removeEducation
     * @author: Fernando Castellar Mendez
     * @description: It removes a an education from the CV in the database
     * @param: int $idUser User's ID where to look for the education to remove
     *         int $idEducation Education's ID to remove
     * @access: public
     * @version: 1.0
     */
    public static function removeEducation($idUser, $idEducation) {
        $conditions[0] = array(     // First condition: Comparing the user's id
            "param1"  => "id_user",
            "operator" => "=",
            "param2" => $idUser);
        $conditions[1] = array(     // Second condition: Comparing the experience's id
            "param1"  => "id_education",
            "operator" => "=",
            "param2" => $idEducation);
        dbDelete("educations", $conditions);    // Calls to the delete function
    }


}