<?php
require_once('system/web/routing/Router.php');
require_once('system/web/mvc/ViewDataDictionary.php');
require_once('system/web/mvc/ViewEngine.php');
require_once('system/exceptions/ClassNotFoundException.php');
require_once('system/exceptions/runtime/UnsupportedOperationException.php');
require_once('system/data/common/DbConnection.php');

require_once('config/Config.php');

function __autoload($class) {
    /**
     * If the file does not exists, the class does not exists.
     */
    if(!file_exists('controllers/' . $class . '.php') && 
       !file_exists('system/exceptions/' . $class . '.php') && 
       !file_exists('system/exceptions/runtime/' . $class . '.php') &&
       !file_exists('viewmodels/' . $class . '.php')) {
        throw new ClassNotFoundException('Class ' . $class . ' does not exists.');        
    }

    if(strpos($class, 'Controller')) {
        require_once('controllers/' . $class . '.php');    
    }
    else if(strpos($class, 'Exception')) {
        if(file_exists('system/exceptions/' . $class . '.php')) {
            require_once('system/exceptions/' . $class . '.php');
        }
        else if(file_exists('system/exceptions/runtime/' . $class . '.php')) {
            require_once('system/exceptions/runtime/' . $class . '.php');
        }
    }
    else if(strpos($class, 'ViewModel')) {
        require_once('viewmodels/' . $class . '.php');
    }
}

/*
 * Create the Router instance and add the routing directions.
 */
$router = new Router();
$router->addRoute('(?P<controller>[^/?]*)/?(?P<action>[^/?]*)/?(?P<id>[^?]*)?.*', '{controller}Controller');

try {
    //router handles the request, redirects to correct controller
    $actionResult = $router->processRequest();
    $actionResult->executeResult();
}
catch(Exception $ex) {
    //fail
    exit($ex->getMessage());
}

$viewEngine = ViewEngine::getInstance();

$viewData = $viewEngine->getViewResult()->getViewData();

$i18n = $viewEngine->getViewResult()->getResourceBundle();

function renderBody() {    
    ViewEngine::getInstance()->render();
}

include('views/shared/' . $viewEngine->getViewResult()->getMasterName() . '.phtml');
?>