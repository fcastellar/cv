/*
 * @function: showLoginPopup
 * @author: Fernando Castellar Mendez
 * @description: It shows a hided div that contains the Login form
 * @version: 1.0
 */
function showLoginPopup() {
    $("#loginPopup").dialog({   // Set the div as dialog
        title: "Login for editing the CV",  // Gives a title to the dialog
        modal: true     // Disables and makes darker the background under this dialog div
    });
};

/*
 * @function: hideLoginPopup
 * @author: Fernando Castellar Mendez
 * @description: It hides the dialog containing the Login form and gives the usual behaviour to the web
 * @version: 1.0
 */
function hideLoginPopup() {
    $("#loginPopup").dialog("close");   // Hides the dialog div and gives control to the CVs view
}

/*
 * @function: login
 * @author: Fernando Castellar Mendez
 * @description: It calls to the Login function with Ajax. It the logging returns ok, it will call to the function
 *               to prepare the CV for its edition
 * @param form form Data in the form of login (user's alias and password)
 * @version: 1.0
 */
function login(form) {
    var loginInfo = {};     // Creates an empty array
    loginInfo["user"] = form.user.value;    // Stores the alias that the user inserted in the array
    loginInfo["password"] = sha1(form.password.value);  // Gets the password that the user inserted, convert it to a
                                                        // sha1 security string, and stores it. This way it doesn't send
                                                        // the password string anywhere
    var loginInfo_json = JSON.stringify(loginInfo); // Converts the array to a JSON string
    $.ajax({    // AJAX CALL
        url: "redirections.php",    // Url to call (the file that will redirect to the right function)
        type: "POST",               // Type to send the data
        data: {                     // Data to send
            action: "login",                // Action describes the action that will take place
            loginInfo_json: loginInfo_json  // The information data parsed before
        },
        success: function(response) {   // If it finished, then...
            if (response == "ok") {         // If it returned OK, then...
                hideLoginPopup();               // Hide the modal windows with the loging form
                prepareCvEdition();             // Prepare the CV for its edition
            }

        },
        error: function(error) {console.log(error);}    // If there was an error, show it in the debugger console tab
    });
}

/*
 * @function: logout
 * @author: Fernando Castellar Mendez
 * @description: It calls to the Logout function, that will destroy the current session and will reload the web, so the
 *               content of the tables and information won't be editable anymore until the next successful login
 * @param form form Data in the form of login (user's alias and password)
 * @version: 1.0
 */
function logout() {
    $.ajax({    // AJAX call
        url: "redirections.php",    // Url to go
        type: "POST",   // Method to send data
        data: {
            action: "logout"    // Action to take
        },
        success: function() {   // If it went ok
            location.href="index.php";  // Reload the web
        },
        error: function(error) {console.log(error);}    // If there was an error, show it in the console
    });
}


/*
 * @function: savePersonalInfo
 * @author: Fernando Castellar Mendez
 * @description: It upgrades the personal information where there should be any change by an AJAX call
 * @version: 1.0
 */
function savePersonalInfo() {
    var personalInfo = {};  // Creates an empty array;
    personalInfo["name"] =  $("#nameValue").html(); // Stores the name in the array
    personalInfo["surname"] =  $("#surnameValue").html();   // Stores the surname or surnames
    personalInfo["birthDate"] =  $("#birthDateValue").html();   // The birth date written
    personalInfo["birthCity"] =  $("#birthCityValue").html();   // The city where the user was born
    personalInfo["birthCountry"] =  $("#birthCountryValue").html(); // The country of birth
    personalInfo["addressCity"] =  $("#addressCityValue").html();   // Stores the city where the user lives
    personalInfo["addressCountry"] =  $("#addressCountryValue").html(); // Stores the country where the user lives
    var personalInfo_json = JSON.stringify(personalInfo);   // Converts the array to a JSON string
    $.ajax({    // Let's call AJAX
        url: "redirections.php",    // Url to call (the file that will redirect to the right function)
        type: "POST",   // Type to send the data
        data: {     // Data to send to the file
            action: "savePersonalInfo",     // Action to tell redirections.php what function it should call
            personalInfo_json: personalInfo_json    // JSON string containing the personal information
        },
        error: function(error) {    // If execution doesn't come back here
            alert ("There was an error!");  // It's clear there was an error
            console.log(error);     // Show it in the debugger console
        }
    });
}