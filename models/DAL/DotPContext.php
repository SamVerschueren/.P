<?php
require_once('system/data/entity/DbContext.php');

class DotPContext extends DbContext {
    
    public $message;
    
    public function __construct() {
        parent::__construct("DotP");
    }
    
    public function onModelCreating(DbModelBuilder $modelBuilder) {
        $modelBuilder->entity("Message")->hasKey("mesId");
    }
}
?>