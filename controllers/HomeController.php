<?php
require_once('system/web/mvc/Controller.php');

class HomeController extends Controller {
    
    public function index() {
        return $this->view();
    }
    
    public function about() {
        return $this->view();
    }
    
    public function contact() {
        return $this->view();
    }
}
?>