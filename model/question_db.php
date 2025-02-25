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
        $db = Database::getDB();

        $number1 = $question->getNumber1();
        $number2 = $question->getNumber2();
        $answer = $question->getAnswer();
        $operand = $question->getOperand();

        $query = 'INSERT INTO questions
                     (number1, number2, answer, operand)
                  VALUES
                     (:number1, :number2, :answer, :operand)';
        $statement = $db->prepare($query);
        $statement->bindValue(':number1', $number1);
        $statement->bindValue(':number2', $number2);
        $statement->bindValue(':answer', $answer);
        $statement->bindValue(':operand', $operand);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function editQuestion($question) {
        
    }

    public static function deleteQuestion($question) {
        
    }

}
