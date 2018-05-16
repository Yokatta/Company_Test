<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Banana
*
* @package 		Core
* @subpackage	Controller
* @author 		Andrew Zhao
* @copyright 	Copyright (c) 2018
*/

class Banana extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
    }

    public function index() {
    	$this->banana();
    }

	public function banana() {
		$this->load->view('welcome_message');
	}
}
