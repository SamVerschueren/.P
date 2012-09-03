<?php
/**
 * Defines a key/value pair that can be set or retrieved.
 * 
 * @package system.collections.generic
 * @since 2012-06-29
 * @author Sam Verschueren  <sam@histranger.be>
 */
class KeyValuePair {
    public $key;
    public $value;	
	
    public function __construct($key, $value) {
        $this->key = $key;
        $this->value = $value;	
    }
}
?>