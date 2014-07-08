<?php
require_once "controllers/User.controller.php";

/*
 * @author Fernando Castellar Mendez
 * @description Class VIEW to show in the screen the User information and the Login form
 * @version 1.0
 */
class UserView {

    /*
     * @function: showPersonalInfo
     * @author: Fernando Castellar Mendez
     * @description: It shows the personal info of the UserController instance given
     * @param: UserController $user User whom personal info will be shown
     * @access: public
     * @version: 1.0
     */
    public static function showPersonalInfo($user) { ?>
        <div class="container personalInfoContainer">
            <div class="information">
                <div class="blueTitle" onclick="showPersonalInfo()">
                    personal info
                </div>
                <div class="button saveButton <?php if (!isset($_SESSION["idUser"])) echo 'hidden';?>" id="personalInfoSaveButton" onclick="savePersonalInfo();">
                    Save
                </div>
                <div id="personalInfoData" class="dataContainer">
                    <div class="userImage">
                        <img src="img/<?php echo $user->image?>" />
                    </div>
                    <div class="label">Name:</div>
                    <div class="value">
                        <span id="nameValue"><?php echo $user->name ?></span>
                        <span id="surnameValue"><?php echo $user->surname ?></span></div>
                    <div class="label">Birth info:</div>
                    <div class="value">
                        <span id="birthDateValue"><?php echo $user->birth_date ?></span> in
                        <span id="birthCityValue"><?php echo $user->birth_city ?></span>,
                        <span id="birthCountryValue"><?php echo $user->birth_country ?></span></div>
                    <div class="label">Residence:</div>
                    <div class="value">
                        <span id="addressCityValue"><?php echo $user->address_city ?></span>,
                        <span id="addressCountryValue"><?php echo $user->address_country ?></span></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    <?php // return TRUE;
    }

    /*
     * @function: insertLogin
     * @author: Fernando Castellar Mendez
     * @description: It shows the Login dialog, but in the beginning it's hidden. It just comes visible when the user
     *               does click in the Login Button
     * @access: public
     * @version: 1.0
     */
    public static function insertLogin() { ?>
        <div class="button <?php if (!isset($_SESSION['idUser'])) echo 'hidden';?>" id="logoutButton" onclick="logout();">
            Logout
        </div>
        <div class="button <?php if (isset($_SESSION['idUser'])) echo 'hidden';?>" id="loginButton" onclick="showLoginPopup();">
            Login
        </div>
        <div id="loginPopup" class="loginPopup">
            <form class="center" name="loginForm">
                <label for="user">User: </label> <input type="text" name="user"><br>
                <label for="password">Pass: </label> <input type="password" name="password"><br>
                <div class="button" onclick="login(loginForm);">Login</div>
            </form>
        </div>
    <?php }

}