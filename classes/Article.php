<?php
class Article {

    public $id;
    public $title;
    public $content;
    public $published_at;

    public static function getAll($conn){
        $sql = "SELECT * 
                FROM article 
                ORDER BY published_at";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    
    }
    
    public static function getByID($conn, $id, $columns = '*'){
        // QUERY STATEMENT TO OBTAIN ID
        $sql = "SELECT $columns
                FROM article
                WHERE id = :id";
        // CODE TO PREPARE QUERY STATEMENT
        $stmt = $conn->prepare($sql);

        // WE'LL BIND THE ID PARAMETER TO THE PLACEHOLDER IN THE QUERY STATEMENT PASSING IN THE ID ARGUEMENT AND BINDING IT AS INTEGER
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
        
        // THEN WE EXECUTE THE QUERY WHICH RETURNS TRUE IF IT WAS SUCCESSFULL 
        if ($stmt->execute()) {
            // THEN WE CAN GET THE RESULT FROM THE STATEMENT...THIS RESULT REPRESENTS THE RESULTS OF THE SQL STATEMEMENT 
            return $stmt->fetch();    
        }
    }
}