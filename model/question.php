<?php


class Question {
    
    private $id, $addendOne, $addendTwo, $answer;

    public function __construct($number1, $number2, $answer, $operand) {
        $this->number1 = $number1;
        $this->number2 = $number2;
        $this->answer = $answer;
        $this->operand = $operand; 
    }
    
    public function getID() {
        return $this->id;
    }
    public function setID($value) {
        $this->id = $value;
    }

    public function getNumber1() {
        return $this->number1;
    }
    public function setNumber1($value) {
        $this->number1 = $value;
    }
    
    public function getNumber2() {
        return $this->number2;
    }
    public function setNumber2($value) {
        $this->number2 = $value;
    }

    public function getAnswer() {
        return $this->answer;
    }
    public function setAnswer($value) {
        $this->answer = $value;
    }
    public function getOperand() {
        return $this->operand;
    }
    public function setOperand($value) {
        $this->operand = $value;
    }
}
