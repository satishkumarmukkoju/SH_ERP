<?php

class Index extends Controller {
    function __construct() {
        parent::__construct();
    }
    
    public function index($module) {
        //  var_dump($_SESSION['loggedIn']);
        if ($_SESSION['loggedIn']) {
       //   Session::init();
            $logged = Session::get('loggedIn');
            header('location: ../home');
            exit();
        }
        $this->view->render('index/index', $module);
    }
    public function login() {
        require EMP_MODULE. '/models/index_model.php';
        $temp = (new Index_model()) -> run($_POST['email'], $_POST['password']);
//        $temp = $this->model->run($_POST['email'], $_POST['password']);
        if ($temp == "Incorect email or password") {
            echo $temp;
        } else {
            echo "/home";
        }
    }
    public function signup() {
        $this->model->signup();
    }
    
    public function frgtpwd(){
        echo $this->model->forgetpwd();
    }
}
