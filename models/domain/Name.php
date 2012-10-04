<?php
class Name {
    
    private $firstName;
    private $lastName;
    
    public function __construct($firstName, $lastName) {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
    }

    private function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    
    public function getFirstName() {
        return $this->firstName;
    }
    
    private function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    public function __toString() {
        return $this->firstName . ' ' . $lastName;
    }
}
?>