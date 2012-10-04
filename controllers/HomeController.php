<?php
require_once('system/web/mvc/Controller.php');
require_once('viewmodels/NameViewModel.php');

class HomeController extends Controller {
    
    public function index() {
        $this->viewData['test'] = 'Hello World';
        
        return $this->view(new NameViewModel());
    }
    
    public function about() {
        return $this->view();
    }
    
    public function contact() {
        return $this->view();
    }
}
?>