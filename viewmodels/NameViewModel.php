<?php
class NameViewModel {
    
    private $firstName;
    private $lastName = 'Verschueren';
    
    public function __construct() {
        $this->firstName = 'Sam';
    }
    
    public function getFirstName() {
        return $this->firstName;
    }
}
?>