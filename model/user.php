<?php
class User {
    private $id, $first_name, $last_name, $user_name, $password, $image;

    public function __construct($first_name, $last_name, $user_name, $password) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->user_name = $user_name;
        $this->password = $password;
    }

    public function getID() {
        return $this->id;
    }
    public function setID($value) {
        $this->id = $value;
    }

    public function getFirstName() {
        return $this->first_name;
    }
    public function setFirstName($value) {
        $this->first_name = $value;
    }

    public function getLastName() {
        return $this->last_name;
    }
    public function setLastName($value) {
        $this->last_name = $value;
    }

    public function getFullName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getUserName() {
        return $this->user_name;
    }
    public function setUserName($value) {
        $this->user_name = $value;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($value) {
        $this->password = $value;
    }

    public function getImage() {
        return $this->image;
    }
    public function setImage($value) {
        $this->image = $value;
    }
}
?>