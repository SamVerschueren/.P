<?php
require_once('system/data/common/DbConnection.php');

/**
 * Represents a combination of the Unit-Of-Work and Repository patterns and enables you to query a database and group together changes that will then be written back to the store as a unit.
 * 
 * @package system.data.entity
 * @since 2012-07-28
 * @author Sam Verschueren  <sam@histranger.be>
 */
abstract class DbContext {
 
    private $dbConnection;
 
    public function __construct(DbConnection $dbConnection = null) {
        if($dbConnection == null) {
            $dbConnection = new DbConnection();
        }
        
        $this->dbConnection = $dbConnection;
        $this->dbConnection->connect();
    }
    
    public abstract function onModelCreating(DbModelBuilder $dbModelBuilder);
}
?>