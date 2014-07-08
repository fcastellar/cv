<?php

require_once "libs/db.php";

/*
 * @author Fernando Castellar Mendez
 * @description Class MODEL for communicating the Users features with the database, getting, inserting, saving and
 *              deleting information about the personal information of the current user
 * @version 1.0
 */
class UserModel {

    /*
     * @function: authenticateUser
     * @author: Fernando Castellar Mendez
     * @description: It compares the login form information with the user in the database, if it fixes with any of the
     *               users, the login process will be successful
     * @param: array $loginInfo Information written in the login form (user's alias and password)
     * @return: UserController instance with the user logged in, or null if the authentication failed
     * @access: public
     * @version: 1.0
     */
    public static function authenticateUser($loginInfo) {
        $conditions[0] = array(     // First condition: user's alias
            "param1"  => "alias",
            "operator" => "=",
            "param2" => $loginInfo["user"]);
        $conditions[1] = array(     // Second condition: password given converted to sha1
            "param1"  => "password",
            "operator" => "=",
            "param2" => $loginInfo["password"]);
        $userInfo = dbSelectFirst("users", '*', $conditions);   // Calls to select function

        if ($userInfo) {    // If it matched with any user in the table
            $user = self::createUser($userInfo);    // Create a new instance of the user
            return $user;
        }
        else
            return null;
    }

    /*
     * @function: loadCurrentUser
     * @author: Fernando Castellar Mendez
     * @description: It load the current user logged in the site and instances it
     * @return: UserController instance with the user logged in
     * @access: public
     * @version: 1.0
     */
    public static function loadCurrentUser() {
        $conditions[0] = array(     // First condition: comparing user's id
            "param1"  => "id_user",
            "operator" => "=",
            "param2" => $_SESSION["idUser"]);
        $userInfo = dbSelectFirst("users", '*', $conditions);   // Calls to select first row available
        if ($userInfo) {    // If success
            $user = self::createUser($userInfo);    // Creates the UserController instance
            return $user;
        }
        else
            return null;
    }

    /*
     * @function: getPersonalInfo
     * @author: Fernando Castellar Mendez
     * @description: It gets the personal information of the user (not needed to be logged in, it looks for the user
     *               with the param given
     * @return: UserController instance with the information completed
     * @access: public
     * @version: 1.0
     */
    public static function getPersonalInfo($idUser) {
        $conditions[0] = array(     // First condition: user's id
            "param1"  => "id_user",
            "operator" => "=",
            "param2" => $idUser);
        $info = dbSelectFirst("personal_info", '*', $conditions);   // Calls to select first row function
        if ($info) {    // If succeed, it stores in a new UserController instance the data it got from the database
            $user = new UserController();
            $user->name = $info["name"];
            $user->surname = $info["surname"];
            $user->birth_date = $info["birth_date"];
            $user->birth_city = $info["birth_city"];
            $user->birth_country = $info["birth_country"];
            $user->address_city = $info["address_city"];
            $user->address_country = $info["address_country"];
            $user->image = $info["image"];
            return ($user);
        }
        else
            return null;
    }

    /*
     * @function: savePersonalInfo
     * @author: Fernando Castellar Mendez
     * @description: It updates the personal information of an user, previously written
     * @access: public
     * @version: 1.0
     */
    public static function savePersonalInfo($user) {
        $conditions[0] = array(     // First condition: Comparing user's id with the session user's id
            "param1"  => "id_user",
            "operator" => "=",
            "param2" => $_SESSION["idUser"]);
        $values["name"]=$user->name;    // Stores in an array the pair name/user's name to save it
        $values["surname"]=$user->surname;  // Stores in values array the pair surname/user's surname to save it
        $values["birth_date"]=$user->birthDate;     // Stores in values array the pair birth date/user's birth date
        $values["birth_city"]=$user->birthCity;     // Stores the pair birth city/user's birth city to save
        $values["birth_country"]=$user->birthCountry; // Stores the pair birth country/user's birth country
        $values["address_city"]=$user->addressCity;   // Stores the pair address city/user's address city
        $values["address_country"]=$user->addressCountry; // Stores the pair address country/user's address country
        dbUpdate("personal_info",$values,$conditions);  // Calls the update function
    }

    /*
     * @function: createUser
     * @author: Fernando Castellar Mendez
     * @description: It instances a new UserController with the Information given (id, alias and type)
     * @param: array $userInfo Array with the three needed values to instance an user
     * @return: UserController instance, loaded with the information given
     * @access: public
     * @version: 1.0
     */
    private static function createUser($userInfo) {
        $user = new UserController();   // Construct of UserController
        $user->setId($userInfo["id_user"]); // Sets the id
        $user->setAlias($userInfo["alias"]);    // Sets the alias
        $user->setType($userInfo["type"]);  // Sets the type
        return $user;
    }

}