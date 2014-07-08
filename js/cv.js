/*
 * @function: showPersonalInfo
 * @author: Fernando Castellar Mendez
 * @description: It shows the personal information of the CV, closing the other tabs
 * @version: 1.0
 */
function showPersonalInfo() {
    closeOpenedInfo();  // Closes all the tabs
    $("#personalInfoData").show();  // Shows the Personal information tab
};

/*
 * @function: showExperience
 * @author: Fernando Castellar Mendez
 * @description: It shows the experience of the CV, closing the other tabs
 * @version: 1.0
 */
function showExperience() {
    closeOpenedInfo();  // Closes all the tabs
    $("#experienceData").show(); // Shows the Experience tab
};

/*
 * @function: showEducation
 * @author: Fernando Castellar Mendez
 * @description: It shows the Education of the CV, closing the other tabs
 * @version: 1.0
 */
function showEducation() {
    closeOpenedInfo();  // Closes all the tabs
    $("#educationData").show(); // Shows the Education tab
};

/*
 * @function: closeOpenedInfo
 * @author: Fernando Castellar Mendez
 * @description: It closes all the tabs, just before opening the required tab
 * @version: 1.0
 */
function closeOpenedInfo() {
        $("#personalInfoData").hide();  // Hides the personal information tab
        $("#experienceData").hide();    // Hides the experience tab
        $("#educationData").hide();     // Hides the education tab
}

/*
 * @function: prepareCvEdition
 * @author: Fernando Castellar Mendez
 * @description: It prepares the information, experience and education tables to be edited, and show the buttons to
 *               save the changes
 * @version: 1.0
 */
function prepareCvEdition() {
    $(".saveButton").show();    // Shows the button to save the changes in every section
    $(".addButton").show();     // Shows the buttons to add a new row in experience and education table
    $("#logoutButton").show();  // Shows the logout button (it was hided)
    $("#loginButton").hide();   // Hides the login button (the user is already logged in)

    $("#personalInfoData").show();  // Shows all the tabs, for a faster edition
    $("#experienceData").show();    // Shows all the tabs
    $("#educationData").show();     // Shows all the tabs

    $("#nameValue").attr('contenteditable','true');     // It sets the option for editing the name field
    $("#surnameValue").attr('contenteditable','true');  // It sets the option for editing the surnames field
    $("#birthDateValue").attr('contenteditable','true');    // It sets the option for editing the birth date field
    $("#birthCityValue").attr('contenteditable','true');    // It sets the option for editing the birth city field
    $("#birthCountryValue").attr('contenteditable','true'); // It sets the options for editing the birth country field
    $("#addressCityValue").attr('contenteditable','true');  // It sets the city or residence field
    $("#addressCountryValue").attr('contenteditable','true');  // It sets the country of residence field

    $("#experienceTable td").attr("contenteditable","true"); // It makes all the cells of the Experience table editable
    $("#educationTable td").attr("contenteditable","true");  // It makes all the cells of the Education table editable

    $(".removeColumn").show();  // It shows the columns with the button to remove an experience or education
}

/*
 * @function: addNewExperience
 * @author: Fernando Castellar Mendez
 * @description: It calls AJAX to create a new row in the table 'experience', and get as answer the view of a new
 *               row for the table printed on screen. It puts that view in the beginning of the table.
 * @version: 1.0
 */
function addNewExperience() {
    $.ajax({    // AJAX call
        url: "redirections.php",    // Url to call
        type: "POST",   // Mode to send the data
        data: {     // Data to send
            action: "addNewExperience"  // The action tha redirections.php will interprete
        },
        success: function(response) {   // If the execution comes back here
            $("#experienceTable > tbody").prepend(response);    // Adds to the beginning of the table the response
            $("#experienceTable td").attr("contenteditable","true");    // Set the content of the table able to edit
        },
        error: function(error) {    // If there was an error
            alert ("There was an error!");  // Show this message
            console.log(error);     // And show in the console debugger what happened
        }
    });
}

/*
 * @function: saveExperience
 * @author: Fernando Castellar Mendez
 * @description: It calls AJAX to upload all the information of the experience table, saving the information of new
 *               rows or changes in old ones
 * @version: 1.0
 */
function saveExperience() {
    $("#experienceTable tr").each(function() {  // For each row...
        if ($(this).children("td:nth-child(1)").text() > 0) {   // If the ID of the first cell (ID) is major than 0
            var experience = {};    // It creates a new array, and stores every cell in its field
                experience["id_experience"] = $(this).children("td:nth-child(1)").text();
                experience["title"] = $(this).children("td:nth-child(3)").text();
                experience["position"] = $(this).children("td:nth-child(4)").text();
                experience["company"] = $(this).children("td:nth-child(5)").text();
                experience["tasks"] = $(this).children("td:nth-child(6)").text();
                experience["skills"] = $(this).children("td:nth-child(7)").text();
                experience["examples"] = $(this).children("td:nth-child(8)").text();
                experience["date_start"] = $(this).children("td:nth-child(9)").text();
                experience["date_end"] = $(this).children("td:nth-child(10)").text();
            var experience_json = JSON.stringify(experience);   // Convert the array to a JSON string
            $.ajax({
                url: "redirections.php",    // Url to call to interprete what to do with the data
                type: "POST",   // Way to send the data
                data: {
                    action: "saveExperience",   // Action to make redirections.php know what to do
                    experience_json: experience_json    // JSON string with the experience cells
                },
                error: function(error) {    // If there was an error
                    alert ("There was an error!");  // Show it
                    console.log(error); // And print in the console of the debugger
                }
            });
        }
    });
}

/*
 * @function: removeExperience
 * @author: Fernando Castellar Mendez
 * @description: It calls AJAX to remove an experience from the database and remove it from the table too
 * @param int idExperience Experience's identifier number
 * @version: 1.0
 */
function removeExperience(idExperience) {
    $.ajax({
        url: "redirections.php",    // Url to call with the function that will call the right controller's method
        type: "POST",   // Mode to send the data
        data: {     // Data to send
            action: "removeExperience", // The action that will interprete redirections.php
            idExperience: idExperience  // The identifier of the experience to remove
        },
        success: function() { // If the execution comes back here
            $("#exp_"+idExperience).remove();   // Remove the row that shows the deleted experience

        },
        error: function(error) {    // If there was an error
            alert ("There was an error!");  // Show it
            console.log(error); // And explain it in the debugger console
        }
    });
}

/*
 * @function: addNewEducation
 * @author: Fernando Castellar Mendez
 * @description: It calls AJAX to create a new row in the table 'education', and get as answer the view of a new
 *               row for the table printed on screen. It puts that view in the first row of the table.
 * @version: 1.0
 */
function addNewEducation() {
    $.ajax({    // AJAX call
        url: "redirections.php",    // Url to call
        type: "POST",   // Mode to send the data
        data: {     // All the data to send
            action: "addNewEducation"   // Param to help redirections.php to know where to go
        },
        success: function(response) {   // If everything seems to be ok
            $("#educationTable > tbody").prepend(response); // Prints a new row in the beginning of the education table
            $("#educationTable td").attr("contenteditable","true"); // Sets the content of all the cells as editable
        },
        error: function(error) {    // If it went wrong
            alert ("There was an error!");  // It prints it on the screen
            console.log(error); // And it shows the error in the debugger console
        }
    });
}

/*
 * @function: saveEducation
 * @author: Fernando Castellar Mendez
 * @description: It calls AJAX to upload all the information of the education table, saving the information of new
 *               rows or changes in old ones
 * @version: 1.0
 */
function saveEducation() {
    $("#educationTable tr").each(function() {   // For each row
        if ($(this).children("td:nth-child(1)").text() > 0) {   // If the ID of the first cell (ID) is major than 0
            var education = {}; // It creates a new array, and stores every cell in its field
                education["id_education"] = $(this).children("td:nth-child(1)").text();
                education["title"] = $(this).children("td:nth-child(3)").text();
                education["type"] = $(this).children("td:nth-child(4)").text();
                education["centre"] = $(this).children("td:nth-child(5)").text();
                education["recap"] = $(this).children("td:nth-child(6)").text();
                education["date_start"] = $(this).children("td:nth-child(7)").text();
                education["date_end"] = $(this).children("td:nth-child(8)").text();
            var education_json = JSON.stringify(education); // Conver the array into a JSON string
            $.ajax({    // AJAX call
                url: "redirections.php",    // As always, calling to the file that interpretes the action
                type: "POST",   // Method POST will be used to send the data
                data: { // All the data
                    action: "saveEducation",    // The current action
                    education_json: education_json  // The array with the education's information
                },
                error: function(error) {    // If execution doesn't seem to be ok
                    alert ("There was an error!");  // It says so
                    console.log(error); // And it shows the error in the debugger console
                }
            });
        }
    });
}

/*
 * @function: removeEducation
 * @author: Fernando Castellar Mendez
 * @description: It calls AJAX to remove an education from the database and remove it from the table too
 * @param int idEducation Education's identifier number
 * @version: 1.0
 */
function removeEducation(idEducation) {
    $.ajax({    // AJAX call
        url: "redirections.php",    // Url to go
        type: "POST",   // Method to send data
        data: { // Data to send
            action: "removeEducation",  // Action for redirections.php
            idEducation: idEducation    // Identifier number of the education to delete
        },
        success: function() {   // If everything went ok
            $("#edu_"+idEducation).remove();    // Remove the row that shows the deleted education

        },
        error: function(error) {    // If it was not ok
            alert ("There was an error!");  // It shows an alert
            console.log(error);     // And prints the error in the debugger console
        }
    });
}