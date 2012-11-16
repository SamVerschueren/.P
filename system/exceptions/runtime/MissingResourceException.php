<?php
/**
 * Signals that a resource is missing.
 * 
 * @package exceptions.runtime
 * @since 2012-11-16
 * @author Sam Verschueren  <sam.verschueren@gmail.com>
 */
class MissingResourceException extends RuntimeException {
    
    public function __construct($message, $code=0, Exception $previous=null) {
        parent::__construct($message, $code, $previous);
    }
}
?>