<?php
require_once('system/web/mvc/Controller.php');

require_once('viewmodels/NameViewModel.php');

class HomeController extends Controller {
    
    public function index() {
        return $this->view(new NameViewModel(new Name('Sam', 'Verschueren')));
    }
    
    public function about() {
        return $this->view();
    }
    
    public function contact() {
        return $this->view();
    }
}
?>