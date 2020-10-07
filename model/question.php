<?php


class Question {
    
    private $id, $question, $answer;

    public function __construct($question, $answer) {
        $this->question = $question;
        $this->answer = $answer;
    }
    
    public function getID() {
        return $this->id;
    }
    public function setID($value) {
        $this->id = $value;
    }

    public function getQuestion() {
        return $this->question;
    }
    public function setQuestion($value) {
        $this->question = $value;
    }

    public function getAnswer() {
        return $this->answer;
    }
    public function setAnswer($value) {
        $this->answer = $value;
    }
}
