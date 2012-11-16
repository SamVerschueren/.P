<?php
/**
 * Thrown to indicate that the code has attempted to cast an object to a subclass of which it is not an instance. 
 * 
 * @package exceptions.runtime
 * @since 2012-11-16
 * @author Sam Verschueren  <sam.verschueren@gmail.com>
 */
class ClassCastException extends RuntimeException {
    
    public function __construct($message, $code=0, Exception $previous=null) {
        parent::__construct($message, $code, $previous);
    }
}
?>