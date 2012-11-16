<?php
require_once('Locale.php');

/**
 * This class helps with the i18n of your application.
 * 
 * @package system.i18n
 * @since 2012-11-15
 * @author Sam Verschueren  <sam.verschueren@gmail.com>
 */
class ResourceBundle {
	
    private static $bundle;
    private static $locale;
    private static $array = array();
    
    /**
     * Gets a resource bundle using the specified base name and the default locale.
     * 
     * @param baseName              The basename of the resourcebundle.
     * @return The ResourceBudle
     */
    public static function getBundle($baseName, Locale $locale=null) {                
        if(!isset(self::$bundle)) {
            self::$bundle = new ResourceBundle();
        }
        
        if($locale == null) {
            $locale = Locale::getDefault();
        }
        
        self::$locale = $locale;
        
        $fileName = $baseName . '.properties';

        if(!file_exists('i18n/' . $fileName)) {
            throw new FileNotFoundException('The file ' . $fileName . ' does not exist.');
        }
        
        self::readFile('i18n/' . $fileName);
        
        $fileName = $baseName . '_' . self::$locale . '.properties';
        
        if(file_exists('i18n/' . $fileName)) {
            self::readFile('i18n/' . $fileName);
        }
        else {
            $fileName = $baseName . '_' . self::$locale->getLanguage() . '.properties';
            
            if(file_exists('i18n/' . $fileName)) {
                self::readFile('i18n/' . $fileName);
            }
        }

        return self::$bundle;
    }
    
    /**
     * @return an enumeration of the keys.
     */
    public function getKeys() {
        return array_keys($this->array);
    }
    
    /**
     * Returns the locale of this resource bundle. This method can be used after a call to getBundle() to determine 
     * whether the resource bundle returned really corresponds to the requested locale or is a fallback.
     * 
     * @return the locale of this resource bundle
     */
    public function getLocale() {
    	return self::$locale;
    }
    
    /**
     * Gets an object for the given key from this resource bundle or one of its parents. This method first tries to 
     * obtain the object from this resource bundle using handleGetObject. If not successful, and the parent resource bundle 
     * is not null, it calls the parent's getObject method. If still not successful, it throws a MissingResourceException.
     * 
     * @throws NullPointerException         if key is null
     * @throws MissingResourceException     if no object for the given key can be found
     * @param key                           the key for the desired object.
     * @return the object for the given key
     */
    public function getObject($key) {
        if($key == null) {
            throw new NullPointerException('The key could not be null');
        }
        
    	if(!array_key_exists($key, self::$array)) {
    	    throw new MissingResourceException('No object for given key ' . $key . ' can be found.');
    	}
        
        return self::$array[$key];
    }
    
    /**
     * Gets a string for the given key from this resource bundle or one of its parents.
     * 
     * @throws NullPointerException         if key is null
     * @throws MissingResourceException     if no string for the given key can be found
     * @throws ClassCastException           if the object found for the given key is not a string
     * @param key                           the key for the desired object.
     * @return the object for the given key
     */
    public function getString($key) {
        if($key == null) {
            throw new NullPointerException('The key could not be null');
        }
        
        if(!array_key_exists($key, self::$array)) {
            throw new MissingResourceException('No string for given key ' . $key . ' can be found.');
        }
        
        if(!is_string(self::$array[$key])) {
            throw new ClassCastException('The object specified with the key is not an string.');
        }
        
        return self::$array[$key];
    }
    
    /**
     * Gets a string array for the given key from this resource bundle or one of its parents. Calling this method is equivalent to calling
     * 
     * @throws NullPointerException         if key is null
     * @throws MissingResourceException     if no string for the given key can be found
     * @throws ClassCastException           if the object found for the given key is not a string array
     * @param key                           the key for the desired string array
     * @return the string array for the given key
     */
    public function getStringArray($key) {
        if($key == null) {
            throw new NullPointerException('The key could not be null');
        }
        
        if(!array_key_exists($key, self::$array)) {
            throw new MissingResourceException('No array for given key ' . $key . ' can be found.');
        }
        
        if(!is_array(self::$array[$key])) {
            throw new ClassCastException('The object specified with the key is not an array.');
        }
        
        return self::$array[$key];
    }
    
    private static function readFile($fileName) {
        $file = fopen($fileName, "r");
        
        $lines = file($fileName);
        
        foreach($lines as $line_num => $line) {
            $line = trim($line);
            
            if(!empty($line) && substr($line, 0, 1) != '#') {
                $exp = explode('=', $line);
                
                // TODO als er in de value ook een = staat wordt er daar ook op gesplitst. Met een for terug als concateneren ofzo...
                self::$array[trim($exp[0])] = trim($exp[1]);
            }
        }
    }
}
?>