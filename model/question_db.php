<?php

class questions_db {

    public static function getQuestions() {
        $db = Database::getDB();

        $query = 'SELECT * FROM questions ORDER BY answer';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        $questions = array();
        foreach ($rows as $row) {
            $i = new Question(
                    $row['number1'], $row['number2'], $row['answer'], $row['operand']);
            $i->setID($row['ID']);
            $questions[] = $i;
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
