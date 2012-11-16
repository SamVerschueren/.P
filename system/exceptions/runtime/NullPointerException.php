<?php
/**
 * Thrown when an application attempts to use null in a case where an object is required.
 * 
 * @package exceptions.runtime
 * @since 2012-11-16
 * @author Sam Verschueren  <sam.verschueren@gmail.com>
 */
class NullPointerException extends RuntimeException {
    
    public function __construct($message, $code=0, Exception $previous=null) {
        parent::__construct($message, $code, $previous);
    }
}
?>