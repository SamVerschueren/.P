<?php
require_once('system/web/mvc/ViewResult.php');

class ViewEngine {
    
    private static $instance;
    private $viewResult;
    
    private function __construct() {
        
    }
    
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new ViewEngine();
        }
        
        return self::$instance;
    }
    
    public function setViewResult(ViewResultBase $viewResult) {
        $this->viewResult = $viewResult;
    }
    
    public function getViewResult() {
        return $this->viewResult;
    }
    
    public function render() {
        try {
            $viewData = $this->getViewResult()->getViewData();
            $model = $viewData['model'];
            
            //include($this->viewResult->findView());
            
            $view = file_get_contents($this->viewResult->findView());
            
            $matches = array();
            
            preg_match_all("/{\\$([a-z]+)(\\.[a-z]+)*}/i", $view, $matches);
            
            foreach($matches[0] as $match) {
                $tokens = explode('.', trim($match, '{}$'));
                
                if(!isset($viewData[$tokens[0]])) {
                    throw new ClassNotFoundException($tokens[0] . ' is not a class.');
                }
                
                if(count($tokens) > 1) {                                        
                    $object = $viewData[array_shift($tokens)];
                    
                    $view = preg_replace('/' . preg_quote($match) . '/', $this->retrieveValue($object, $tokens), $view);
                }
                else {
                    $view = preg_replace('/' . preg_quote($match) . '/', $viewData[$tokens[0]], $view);
                }
            }
            
            //$view = preg_replace('/{\$([a-z]+)}/e', "\$viewData['$1']" . $viewData['$1'], $view);
            
            echo $view;
        }
        catch(FileNotFoundException $ex) {
            echo '<div id="error">' . $ex->getMessage() . '</div>';
        }
    }

    private function retrieveValue($object, array $values) {
        if(is_object($object)) {
            $reflectionClass = new ReflectionClass($object);
            
            try {
                $property = $reflectionClass->getProperty(array_shift($values));
                $property->setAccessible(true);
                
                $val = $property->getValue($object);
                
                return $this->retrieveValue($val, $values);
            }
            catch(ReflectionException $ex) {
                throw new UnsupportedOperationException($ex->getMessage() . ' in class ' . get_class($object), $ex->getCode());
            }   
        }
        else {
            if(count($values) > 0) {
                throw new ClassNotFoundException($object . ' is not a class.');
            }
            else {
                return $object;
            }
        }
    }
}
?>