<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Kolkata");
class Test extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		//$this->load->model('api');
    }

function index(){
    $this->load->view('game_result');
}


}