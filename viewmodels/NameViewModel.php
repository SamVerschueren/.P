<?php
require_once('models/domain/Name.php');

class NameViewModel {
    
    private $name;
    private $version = '1.0';
    
    public function __construct(Name $name) {
        $this->name = $name;
    }
}
?>