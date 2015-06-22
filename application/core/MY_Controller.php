<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_Controller
 *
 * @author Hardik Raval
 */
class Admin_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Check Sesstion
        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin/login');
        }
    }

}

/**
 * Description of User_controller
 * this controller is use
 * 
 * @author Hardik Raval
 * 
 */
class User_Auth_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        //Check User Session
        if (!$this->session->userdata('userarea')) {
            redirect('auth/login');
        }
    }

}

class Base_Controller extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    }
}
