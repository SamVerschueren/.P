<?php
require_once('NotFoundException.php');

/**
 * Exception when URL is malformed.
 * 
 * @package exceptions
 * @since 2012-07-11
 * @author Sam Verschueren  <sam@histranger.be>
 */
class MalformedURLException extends Exception {
    
    public function __construct($message, $code=0, Exception $previous=null) {
        parent::__construct($message, $code, $previous);
    }
}
?>