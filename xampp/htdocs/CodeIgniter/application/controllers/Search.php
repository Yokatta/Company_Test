<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Company Search Data Collection
*
* @package 		Core
* @subpackage	Controller
* @author 		Andrew Zhao
* @copyright 	Copyright (c) 2018
*/

class Search extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Company_DB');
    }

    public function index() {
    	$this->search();
    }

	public function search() {
		$data = array();
		// $test = $this->Company_DB->search();
		$this->load->view('search/search',$data);
	}

	public function search_ajax() {
		$data = array();
		//$data = 
		$out_put = array();
		$phrase = $this->input->post('search_phrase');
		// $data = $this->Company_DB->search_get_rows($phrase);
		$data = $this->Company_DB->search_other($phrase);
		foreach ($data as $key => $value) {
			$out_put[$value->company_id]['company_name'] = $value->company_name;
			$out_put[$value->company_id]['status'] = $value->status;
			$out_put[$value->company_id]['lang'] = $value->lang;
			if ($value->excess_pdf == NULL)
				$out_put[$value->company_id]['excess_pdf']='';
			else {
			 	$out_put[$value->company_id]['excess_pdf']=$value->excess_pdf;
			 }
			if ($value->umbrella_pdf == NULL)
				$out_put[$value->company_id]['umbrella_pdf']='';
			else {
			 	$out_put[$value->company_id]['umbrella_pdf']=$value->umbrella_pdf;
			 }
			if ($value->e_o_pdf == NULL)
				$out_put[$value->company_id]['e_o_pdf']='';
			else {
			 	$out_put[$value->company_id]['e_o_pdf']=$value->e_o_pdf;
			 }
			// if ($value->property_pdf == NULL)
			//$out_put[$value->company_id]['property_pdf']='';
			// else {
			//  	$out_put[$value->company_id]['property_pdf']=$value->property_pdf;
			//  }
		}
		$data_property = $this->Company_DB->search_property_pdf($phrase);
		foreach ($data_property as $key => $value) {
			if(isset($out_put[$value->company_id]['property_pdf'])){
				$out_put[$value->company_id]['property_pdf'].=' OR '.$value->property_pdf;
			}else{
				$out_put[$value->company_id]['property_pdf'] = $value->property_pdf;
			}
		}

		$data_liability = $this->Company_DB->search_liability_pdf($phrase);
		foreach ($data_liability as $key => $value) {
			if(isset($out_put[$value->company_id]['liability_pdf'])){
				$out_put[$value->company_id]['liability_pdf'].=' OR '.$value->liability_pdf;
			}else{
				$out_put[$value->company_id]['liability_pdf'] = $value->liability_pdf;
			}
		}
		$result['result'] = $out_put;
		// var_dump($out_put);
		$this->load->view('search/search_ajax',$result);
	}
}
