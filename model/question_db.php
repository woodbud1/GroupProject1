<?php

class questions_db {

    public static function getQuestions() {
        $db = Database::getDB();

        $query = 'SELECT * FROM questions';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $questions = array();
        foreach ($rows as $row) {
            $i = new Question(
                    $row['addendOne'], $row['addendTwo'], $row['sum']);
            $i->setID($row['ID']);
            $users[] = $i;
        }
        return $questions;
    }

    public static function addQuestion($question) {
        
    }

    public static function editQuestion($question) {
        
    }

    public static function deleteQuestion($question) {
        
    }

}
