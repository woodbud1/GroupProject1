<?php


class Question {
    
    private $id, $addendOne, $addendTwo, $answer;

    public function __construct($addendOne, $addendTwo, $answer) {
        $this->addendOne = $addendOne;
        $this->addendTwo = $addendTwo;
        $this->answer = $answer;
    }
    
    public function getID() {
        return $this->id;
    }
    public function setID($value) {
        $this->id = $value;
    }

    public function getAddendOne() {
        return $this->addendOne;
    }
    public function setAddendOne($value) {
        $this->addendOne = $value;
    }
    
    public function getAddendTwo() {
        return $this->addendTwo;
    }
    public function setAddendTwo($value) {
        $this->addendTwo = $value;
    }

    public function getAnswer() {
        return $this->answer;
    }
    public function setAnswer($value) {
        $this->answer = $value;
    }
}
