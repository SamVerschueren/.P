<?php
require_once('system/web/mvc/ViewResult.php');
require_once('system/i18n/ResourceBundle.php');

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
        $viewData = $this->getViewResult()->getViewData();
        $model = $viewData['model'];
        
        if(Config::$BUNDLE_NAME != "") {
            $bundle = ResourceBundle::getBundle(Config::$BUNDLE_NAME);
        }
        
        include($this->viewResult->findView());
    }
}
?>