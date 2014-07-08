<?php

/**
 *
 * Lib with functions to manage the data base. We can to Select, update, insert or remove with the help of this file
 * @author Fernando Castellar
 * @version 1.0
 *
 */


/*
 * @function: dbConnect
 * @author: Fernando Castellar Mendez
 * @description: Establish a connection with the database, according to the information of init.php. It uses MySQLi
 * @return: The connection with the database
 * @version: 1.0
 */
    function dbConnect () {
        try {   // Exception treatment
            $dbConnection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); // Tries the connection
        } catch (Exception $e_mysql) {  // If there is an error
            echo "There was an error trying to connect to the data base" . BD_NOMBRE . " in " . BD_HOST; // It says it
        }
        return $dbConnection;
    }

/*
 * @function: dbSelect
 * @author: Fernando Castellar Mendez
 * @description: Makes a select in the database, depending on the params given
 * @return: The results of the query stored in an array, or null if there was no result
 * @param: string $table The table where to do the select query
 *         string $fields The fields to get in the query (default: *)
 *         array $conditions An array with the conditions of the WHERE part of the query. Each one contains the name
 *                           of the cell, the operator to make comparation, and the value to compare with
 *         string $orderField The field that will be used to order the results (default NULL)
 *         string $orderType ASC for ascending order, DESC for descending order
 * @version: 1.0
 */
    function dbSelect($table, $fields="*", $conditions = NULL, $orderField=NULL, $orderType=NULL) {
        $dbConnection = dbConnect();    // Get a connection with the database
        $whereQuery = "";   // Empty string for the WHERE part of the query
        $orderQuery = "";   // Empty string for the ORDER BY part of the query

        if (isset($conditions)) {   // If there are conditions
            foreach ($conditions as $condition) {   // For each condition of the array...
                if ($whereQuery != "")  // If it's not the first condition...
                    $whereQuery .= " AND ";     // it prints an AND as connection between conditions
                else    // If it's the first condition
                    $whereQuery = " WHERE ";    // It prints the WHERE to start the WHERE part of the query
                $whereQuery .= $condition["param1"] . $condition["operator"] . "'" .$condition["param2"] . "'";
                                                // And it prints the current values of the array in the WHERE string
            }
        }
        if (isset($orderField))     // If there is an order
            $orderQuery = "ORDER BY " .$orderField." ".$orderType;      // Writes it in the ORDER BY string

        $query = "SELECT " .$fields. " FROM " .$table. " " . $whereQuery. " " .$orderQuery;     // The final query

        $execQuery = $dbConnection->query($query);  // Executes the query with the connection of the beginning
        if ($execQuery) {   // If it went ok
            $result = $execQuery->fetch_all(MYSQLI_ASSOC);  // Stores the result in an array
            $execQuery->close();    // Closes the query
        }
        else    // If there were problems
            $result = null; // The result is null

        $dbConnection->close(); // Closes the connection with the database
        return $result; // And return the result (array or null)
    }

/*
 * @function: dbSelectFirst
 * @author: Fernando Castellar Mendez
 * @description: Makes a select in the database, depending on the params given, but it return only one row (first one)
 * @return: The first row of the results after executing the query, stored in an array. Or null if there was no result
 * @param: string $table The table where to do the select query
 *         string $fields The fields to get in the query (default: *)
 *         array $conditions An array with the conditions of the WHERE part of the query. Each one contains the name
 *                           of the cell, the operator to make comparation, and the value to compare with
 *         string $orderField The field that will be used to order the results (default NULL)
 *         string $orderType ASC for ascending order, DESC for descending order
 * @version: 1.0
 */
    function dbSelectFirst($table, $fields="*", $conditions = NULL, $orderField=NULL, $orderType=NULL) {
        $result = dbSelect($table, $fields, $conditions, $orderField, $orderType); // Calls the normal Select function
        if ($result) return $result[0]; // If there was a result, return the first row taken
        else return null;   // If there was no result, return null
    }

/*
 * @function: dbUpdate
 * @author: Fernando Castellar Mendez
 * @description: Updates given values for a specific row in the database
 * @return: TRUE if success, FALSE if fails
 * @param: string $table The table where to do the update query
 *         array $values Pairs Key/Value to save
 *         array $conditions Condition (param, operator, value) to find the row to update
 * @version: 1.0
 */
    function dbUpdate($table, $values, $conditions) {
        $dbConnection = dbConnect();    // Get a connection with the database
        $stringValues = ""; // Empty string for the values
        $whereQuery = "";   // Empty string for the condition to find the row to update

        foreach ($values as $key => $value) {   // For each pair Key/Value
            if ($stringValues == "") $stringValues .= $key ."='".$value."' ";   // If it's the first one, doesn't print
            else $stringValues .= ", ".$key ."='".$value."' ";                  // a coma. If it isn't, prints a coma
        }

        foreach ($conditions as $condition) {   // For each condition
            if ($whereQuery != "")      // If it's not the first one
                $whereQuery .= " AND "; // inserts a connector AND
            else
                $whereQuery = " WHERE ";    // Else, inserts the starting WHERE
            $whereQuery .= $condition["param1"] . $condition["operator"] . "'" .$condition["param2"] . "'";
                                            // And it prints the current values of the array in the WHERE string
        }

        $query = "UPDATE ".$table. " SET " . $stringValues . $whereQuery;   // The final query

        $execQuery = $dbConnection->query($query);  // Executes query
        if ($execQuery) // If it returned the number of rows updated
            return true;    // It means everything went ok
        else    //If it doesn't return the number of updated rows
            return false;   // It means something went wrong
    }

/*
 * @function: dbInsert
 * @author: Fernando Castellar Mendez
 * @description: Inserts a new row in a table
 * @return: The new ID if everything went ok, FALSE if it went wrong
 * @param: string $table The table where to do the insert
 *         array $values Pairs Key/Value with the initial information of the row
 * @version: 1.0
 */
    function dbInsert($table, $values) {
        $dbConnection = dbConnect();    // Get a connection with the database
        $stringFields = implode(",", array_keys($values));  // Takes the keys of the Values Array into a string,
                                                            // separated with comas
        $stringValues = "'" . implode("','",$values) ."'";  // Takes the values of the Values Array into a string,
                                                            // separated with comas
        $query = "INSERT INTO ".$table. " (".$stringFields.") VALUES (" . $stringValues .")"; // The final query

        $execQuery = $dbConnection->query($query);  // Executes the query
        if ($execQuery)     // If everything went ok
            return mysqli_insert_id($dbConnection); // Returns the las ID inserted in the database
        else    // If something went wrong
            return false;   // Return FALSE
    }

/*
 * @function: dbDelete
 * @author: Fernando Castellar Mendez
 * @description: Removes a row from a table
 * @return: TRUE if it went ok, FALSE if something went wrong
 * @param: string $table The table where to do the insert
 *         array $conditions Condition (param, operator, value) to find the row to remove
 * @version: 1.0
 */
    function dbDelete($table, $conditions) {
        $dbConnection = dbConnect();    // Get a database connection
        $whereQuery = "";   // WHERE empty string
        foreach ($conditions as $condition) {   // For each condition
            if ($whereQuery != "")          // If it's not the first one
                $whereQuery .= " AND ";     // inserts a connector AND
            else
                $whereQuery = " WHERE ";    // Else, inserts the starting WHERE
            $whereQuery .= $condition["param1"] . $condition["operator"] . "'" .$condition["param2"] . "'";
                                            // And it prints the current values of the array in the WHERE string
        }
        $query = "DELETE FROM ".$table." ".$whereQuery; // The final delete query
        $execQuery = $dbConnection->query($query);  // Executes the query
        if ($execQuery) // If it returned the number of rows removed
            return true;    // It means everything went ok
        else    //If it doesn't return the number of deleted rows
            return false;   // It means something went wrong
    }

?>