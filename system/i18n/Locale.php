<?php
/**
 * A Locale object represents a specific geographical, political, or cultural region. An operation 
 * that requires a Locale to perform its task is called locale-sensitive and uses the Locale to tailor 
 * information for the user. For example, displaying a number is a locale-sensitive operation--the number 
 * should be formatted according to the customs/conventions of the user's native country, region, or culture.
 * 
 * @package system.i18n
 * @since 2012-11-16
 * @author Sam Verschueren  <sam.verschueren@gmail.com>
 */
class Locale {
    
    private $language;
    private $country;
    
    /**
     * Construct a locale from language, country.
     * 
     * @param language                  lowercase two-letter ISO-639 code.
     * @param country                   uppercase two-letter ISO-3166 code.
     * @throws NullPointerException     if the language argument is null.
     * @throws InvalidArgumentException if the language or country argument does not consist out of a two-letter code.
     */
    public function __construct($language, $country=null) {
        $this->setLanguage($language);
        $this->setCountry($country);
    }
    
    /**
     * Sets the language code
     * 
     * @param language                  lowercase two-letter ISO-639 code.
     * @throws NullPointerException     if the language argument is null.
     * @throws InvalidArgumentException if the language argument does not consist out of a two-letter code.
     */
    private function setLanguage($language) {
        if($language == null) {
            throw new NullPointerException('The language code could not be null.');
        }
        
        if(strlen($language) != 2) {
            throw new InvalidArgumentException('The language code must consist out of 2 characters.');
        }
        
        $this->language = $language;
    }
    
    /**
     * Returns the language code for this locale, which will either be the empty string or a lowercase ISO 639 code.
     * 
     * @return the language code for this locale.
     */
    public function getLanguage() {
        return $this->language;
    }
    
    /**
     * Sets the country code.
     * 
     * @param country                   uppercase two-letter ISO-3166 code.
     * @throws InvalidArgumentException if the country argument does not consist out of a two-letter code.
     */
    private function setCountry($country) {
        if($country != null) {
            if(strlen($country) != 2) {
                throw new InvalidArgumentException('The language code must consist out of 2 characters.');
            }
            
            $this->country = strtoupper($country);
        }
    }
    
    /**
     * Returns the country/region code for this locale, which will either be the empty string or an upercase ISO 3166 2-letter code.
     * 
     * @return the country code for this locale.
     */
    public function getCountry() {
        return $this->country;
    }
    
    public function __toString() {
        $country = $this->getCountry();
        
        if(empty($country)) {
            $country = strtoupper($this->getLanguage());
        }
        
        return $this->getLanguage() . '_' . $country;
    }
}
?>