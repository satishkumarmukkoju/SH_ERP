<?php 

class Tickets extends Controller{
    
    function __construct() {
        parent::__construct();
        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('location: ../index');
            exit();
        }   
    }
    
    public function index(){
         require EMP_MODULE. '/models/global_model.php';
            $this->view->user_details = (new Global_model()) -> getUserDetails($_SESSION['loggedIn']);
            $this->view->all_user_details = (new Global_model()) -> getAllUserDetails();
            $this->view->get_hldys = (new Global_model()) -> get_hldys();
            $this->view->chosen_hldys = (new Global_model()) -> get_chosen_hldys();
            require CUST_MODULE. '/models/tickets_model.php';
            $this -> view -> get_tickets = (new Tickets_model()) -> getTickets();
            $this -> view -> tickets_notfcn =  (new Tickets_model()) -> asgndTckts();
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
            $this->view->render('tickets/index', CUST_MODULE, 'ajax');
            }else{
            $this->view->render('tickets/index', CUST_MODULE, 'notajax');
            }
    }
    
    // @rendering ticket view page
    public function view($tckt_id){
            require EMP_MODULE. '/models/global_model.php';
            $this->view->user_details = (new Global_model()) -> getUserDetails($_SESSION['loggedIn']);
            $this->view->all_user_details = (new Global_model()) -> getAllUserDetails();
            $this->view->get_hldys = (new Global_model()) -> get_hldys();
            $this->view->chosen_hldys = (new Global_model()) -> get_chosen_hldys();
            require CUST_MODULE. '/models/tickets_model.php';
            $this->view->viewTicket = (new Tickets_model()) -> viewTicket($tckt_id);
            $this -> view -> tickets_notfcn =  (new Tickets_model()) -> asgndTckts();
            // @Checking url come form ajax or not
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
            $this-> view -> render('ticket_view/index', CUST_MODULE, 'ajax');
            }else{
            $this-> view -> render('ticket_view/index', CUST_MODULE, 'notajax');
            }
    }
    
    // @update ticket ttl or desc or catgoy or assignee or comment
    public function updt(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
        require CUST_MODULE. '/models/tickets_model.php';
         echo json_encode((new Tickets_model()) -> updtTicket());
        }else {
            header("Location: /error");
        }
    }
    
    
    public function ntf(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
        require CUST_MODULE. '/models/tickets_model.php';
         echo (new Tickets_model()) -> Notfcn();
        }else {
            header("Location: /error");
        }
    }
    
    public function fltr(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
        require CUST_MODULE. '/models/tickets_model.php';
         echo json_encode((new Tickets_model()) -> tcktFltrng());
        }else {
            header("Location: /error");
        }
    }
    
    public function lodmre(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
        require CUST_MODULE. '/models/tickets_model.php';
         echo json_encode((new Tickets_model()) -> getTickets());
        }else {
            header("Location: /error");
        }
    }
    
}


?>