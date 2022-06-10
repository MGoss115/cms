<?php

/**
 * Get the article record based on the ID
 *
 * @param object $conn Connection to the database
 * @param integer $id the article ID
 *
 * @return mixed An associative array containing the article with that ID, or null if not found
 */
function getArticle($conn, $id)
{
    // QUERY STATEMENT TO OBTAIN ID
    $sql = "SELECT *
            FROM article
            WHERE id = ?";
     // CODE TO PREPARE QUERY STATEMENT
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {

        echo mysqli_error($conn);

    } else {
         // WE'LL BIND THE ID PARAMETER TO THE PLACEHOLDER IN THE QUERY STATEMENT PASSING IN THE ID ARGUEMENT AND BINDING IT AS AN INTEGER
        mysqli_stmt_bind_param($stmt, "i", $id);
        // THEN WE EXECUTE THE QUERY WHICH RETURNS TRUE IF IT WAS SUCCESSFULL 
        if (mysqli_stmt_execute($stmt)) {
            // THEN WE CAN GET THE RESULT FROM THE STATEMENT...THIS RESULT REPRESENTS THE RESULTS OF THE SQL STATEMEMENT 
            $result = mysqli_stmt_get_result($stmt);
            // BELOW ALLOWS US TO GET THE RESULT IN AN ASSOCIATIVE ARRAY 
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}
// IF NO RECORD IS FOUND THEN THE METHOD WILL RETURN NULL