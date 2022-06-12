<?php

/**
 * Get the article record based on the ID
 *
 * @param object $conn Connection to the database
 * @param integer $id the article ID
 *
 * @return mixed An associative array containing the article with that ID, or null if not found
 */
function getArticle($conn, $id, $columns = '*')
{
    // QUERY STATEMENT TO OBTAIN ID
    $sql = "SELECT $columns
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

/**
 * Validate the article properties
 *
 * @param string $title Title, required
 * @param string $content Content, required
 * @param string $published_at Published date and time, yyyy-mm-dd hh:mm:ss if not blank
 *
 * @return array An array of validation error messages
 */
function validateArticle($title, $content, $published_at)
{
    $errors = [];

    if ($title == '') {
        $errors[] = 'Title is required';
    }
    if ($content == '') {
        $errors[] = 'Content is required';
    }

    if ($published_at != '') {
        $date_time = date_create_from_format('Y-m-d H:i:s', $published_at);

        if ($date_time === false) {

            $errors[] = 'Invalid date and time';

        } else {

            $date_errors = date_get_last_errors();

            if ($date_errors['warning_count'] > 0) {
                $errors[] = 'Invalid date and time';
            }
        }
    }

    return $errors;
}

?>