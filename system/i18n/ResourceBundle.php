<?php
/**
 * This class helps with the i18n of your application.
 * 
 * @package system.i18n
 * @since 2012-11-15
 * @author Sam Verschueren  <sam.verschueren@gmail.com>
 */
class ResourceBundle {
	
    private static $bundle;
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
        
        $fileName = $baseName . '.properties';
        
        if($locale == null) {
            $languageCode = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            
            $fileName = $baseName . '_' . $languageCode . '.properties';
        }
        
        if(!file_exists('i18n/' . $fileName)) {
            $fileName = $baseName . '.properties';
            
            if(!file_exists('i18n/' . $fileName)) {
                throw new FileNotFoundException('The file ' . $fileName . ' does not exist.');
            }
        }
        
        self::readFile('i18n/' . $fileName);
        
        return self::$bundle;
    }
    
    /**
     * @return array 		Returns an enumeration of the keys.
     */
    public function getKeys() {
        return array_keys($this->array);
    }
    
    /**
     * @return locale		Returns the locale of this resource bundle.
     */
    public function getLocale() {
    	
    }
    
    public function getObject($key) {
    	
    }
    
    public function getString($key) {
        if(!array_key_exists($key, self::$array)) {
            throw new Exception("The key " + $key + " does not exist");
        }
        
        return self::$array[$key];
    }
    
    public function getStringArray($key) {

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