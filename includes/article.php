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
            WHERE id = :id";
     // CODE TO PREPARE QUERY STATEMENT
    $stmt = $conn->prepare($sql);

    // WE'LL BIND THE ID PARAMETER TO THE PLACEHOLDER IN THE QUERY STATEMENT PASSING IN THE ID ARGUEMENT AND BINDING IT AS INTEGER
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
    // THEN WE EXECUTE THE QUERY WHICH RETURNS TRUE IF IT WAS SUCCESSFULL 
     if ($stmt->execute()) {
        // THEN WE CAN GET THE RESULT FROM THE STATEMENT...THIS RESULT REPRESENTS THE RESULTS OF THE SQL STATEMEMENT 
        return $stmt->fetch(PDO::FETCH_ASSOC);    
    }
}
// IF NO RECORD IS FOUND THEN THE METHOD WILL RETURN NULL
?>