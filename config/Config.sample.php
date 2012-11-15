<?php
/**
 * The config file.
 * Never commit this file to github or whatever.
 * 
 * @package config
 * @author Sam Verschueren  <sam.verschueren@gmail.com>
 */
class Config {
    // Database variables
    public static $DB = '';
    public static $DB_HOST = '';
    public static $DB_USER = '';
    public static $DB_PASSWORD = '';
    
    // Fill this in if website is placed in subfolder
    public static $SUBDIR = '';
    
    // Fill in the domainname
    public static $SERVER = 'http://localhost';
    
    // The name of the session
    public static $SESSION_NAME = 'session';
	
    // The basename for the resourcebundle. Leave empty if i18n is not used.
    public static $BUNDLE_NAME = '';
}
?>