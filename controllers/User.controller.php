<?php

require_once "models/User.model.php";
require_once "views/User.view.php";
require_once "controllers/Cv.controller.php";

class UserController {

/*
 * @author Fernando Castellar Mendez
 * @description Class CONTROLLER for the management of users. Its instance is used to create and update user's
 *              information, but not the user's CV. With this class, the site can make login, and update personal data
 * @version 1.0
 *
 * @property int $id User's identifier
 * @property string $alias User's alias to login
 * @property string $type Type of user (editor, reader)
 * @property string $name Real user's name (not alias)
 * @property string $surname User's surname or surnames
 * @property date $birthDate User's date of birth
 * @property string $birthCity City where the user was born
 * @property string $birthCountry Country where the user was born
 * @property string $addressCity City where the user lives nowadays
 * @property string $addressCountry Country where the user lives nowadays
 * @property string $image Name of the file type image with the photo of the user
*/

    private $id;
    private $alias;
    private $type;

    public $name;
    public $surname;
    public $birthDate;
    public $birthCity;
    public $birthCountry;
    public $addressCity;
    public $addressCountry;
    public $image;

    public function __construct() {
    }

    /*
     * @function: setId
     * @author: Fernando Castellar Mendez
     * @description: It sets an Identifier number to the user
     * @param: int $id User's ID to set.
     * @access: public
     * @version: 1.0
     */
    public function setId($id) { $this->id = $id; }

    /*
     * @function: setAlias
     * @author: Fernando Castellar Mendez
     * @description: It sets an alias to the user, it will be used for loging in
     * @param: string $alias Alias to set to the user
     * @access: public
     * @version: 1.0
     */
    public function setAlias($alias) { $this->alias = $alias; }

    /*
     * @function: setType
     * @author: Fernando Castellar Mendez
     * @description: It sets an user type to the current user
     * @param: string $type Type of user that will be set to the instancied user
     * @access: public
     * @version: 1.0
     */
    public function setType($type) { $this->type = $type; }

    /*
     * @function: getId
     * @author: Fernando Castellar Mendez
     * @description: Used to get the user's identifier
     * @return: User's ID
     * @access: public
     * @version: 1.0
     */
    public function getId() { return $this->id; }

    /*
     * @function: getAlias
     * @author: Fernando Castellar Mendez
     * @description: Used to get the user's alias
     * @return: The user's alias
     * @access: public
     * @version: 1.0
     */
    public function getAlias() { return $this->alias; }

    /*
     * @function: getType
     * @author: Fernando Castellar Mendez
     * @description: Used to get the type of user
     * @return: The type of the instancied user
     * @access: public
     * @version: 1.0
     */
    public function getType() { return $this->type; }

    /*
     * @function: personalInfo
     * @author: Fernando Castellar Mendez
     * @description: It gets the personal info from the Model class and shows it with a function from the View class.
     *               There's no need to be authentified to see the CV, so we have to load the information with the
     *               identifier number.
     * @param: int $idUser User's ID with the information to show.
     * @access: public
     * @version: 1.0
     */
    public static function personalInfo($idUser) {
        $user = UserModel::getPersonalInfo($idUser);  // Calls to the Model class to instance the user with that ID
        UserView::showPersonalInfo($user);            // Calls to the View class to print it in the screen
    }

    /*
     * @function: savePersonalInfo
     * @author: Fernando Castellar Mendez
     * @description: It calls to the User Model class to update the personal information of the user logged in, saving
     *               possible changes.
     * @param: array $personalInfo Array with all the needed data.
     * @return: True if the identification went ok, False if the identification went wrong
     * @access: public
     * @version: 1.0
     */
    public static function savePersonalInfo($personalInfo) {
        $user = UserModel::loadCurrentUser();   // Load the instance of the user who logged in
        $user->name = $personalInfo["name"];    // Sets the (new) user's name
        $user->surname = $personalInfo["surname"];  // Sets the (new) user's surname
        $user->birthDate = $personalInfo["birthDate"];  // Sets the (new) birth date of the user
        $user->birthCity = $personalInfo["birthCity"];  // Sets the (new) birth city of the user
        $user->birthCountry = $personalInfo["birthCountry"];    // Sets the (new) birth country
        $user->addressCity = $personalInfo["addressCity"];      // Sets the (new) city where the user lives
        $user->addressCountry = $personalInfo["addressCountry"];    // Sets the (new) country where the user lives
        UserModel::savePersonalInfo($user); // Calls to the Model class to save the possible changes
    }

    /*
     * @function: login
     * @author: Fernando Castellar Mendez
     * @description: It instances the user if the identification goes ok
     * @param: array $info It gets two values, alias and password, to try to login
     * @return: True if the identification went ok, False if the identification went wrong
     * @access: public
     * @version: 1.0
     */
    public static function login($info) {
        $user = UserModel::authenticateUser($info); // Calls to the Model class to compare alias and password
        if ($user) {    // If there is a pair Alias / Password that matches
            $_SESSION["idUser"] = $user->getId();   // Sets the user's to the new instance
            $_SESSION["aliasUser"] = $user->getAlias(); // Sets the user's alias to the new instance
            $_SESSION["typeUser"] = $user->getType();   // Sets the type of user to the new instance
            return true;    // The authentication went ok
        } else  //  If there's not a pair Alias / Password that matches
            return false;   // The authentication went wrong
    }

    /*
     * @function: insertLogin
     * @author: Fernando Castellar Mendez
     * @description: It inserts the login form under the CV's view, but hided, waiting to the Login Button to be clicked
     * @access: public
     * @version: 1.0
     */
    public static function insertLogin() {
        UserView::insertLogin();    // Calls to the View class to print on screen the Login form
    }

}