<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Company Search Data Collection
*
* @package 		Core
* @subpackage	Model
* @author 		Andrew Zhao
* @copyright 	Copyright (c) 2018
*/

Class Company_DB extends CI_Model{
	public function __construct() 
	{
		parent::__construct();
	}

	public function search_other($phrase) {
		$this->db->flush_cache();
		$this->db->select("company.*,
			excess_table.pdf_name as excess_pdf,
			umbrella_table.pdf_name as umbrella_pdf,
			e_o_table.pdf_name as e_o_pdf");
		$this->db->from("company");
		$this->db->join("excess","excess.company_id=company.company_id","left");
		$this->db->join("pdf_table as excess_table","excess_table.pdf_id=excess.pdf_id","left");
		$this->db->join("umbrella","umbrella.company_id=company.company_id","left");
		$this->db->join("pdf_table as umbrella_table","umbrella_table.pdf_id=umbrella.pdf_id","left");
		$this->db->join("e_o","e_o.company_id=company.company_id","left");
		$this->db->join("pdf_table as e_o_table","e_o_table.pdf_id=e_o.pdf_id","left");
		$this->db->group_start();
		$this->db->like('company.company_name',$phrase);
		$this->db->group_end();

		$query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result();
	}

	public function search_property_pdf($phrase) {
		$this->db->flush_cache();
		$this->db->select("company.*,
			GROUP_CONCAT(property_table.pdf_name SEPARATOR ' & ') as property_pdf,
			property.set_id");
		$this->db->from("company");
		$this->db->join("property","property.company_id=company.company_id","left");
		$this->db->join("pdf_table as property_table", "property_table.pdf_id=property.pdf_id","left");
		$this->db->group_start();
		$this->db->like('company.company_name',$phrase);
		$this->db->group_end();
		$this->db->group_by("company.company_name");
		$this->db->group_by("property.set_id");
		$query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result();
	}

	public function search_liability_pdf($phrase) {
		$this->db->flush_cache();
		$this->db->select("company.*,
			GROUP_CONCAT(liability_table.pdf_name SEPARATOR ' & ') as liability_pdf,
			liability.set_id");;
		$this->db->from("company");
		$this->db->join("liability","liability.company_id=company.company_id","left");
		$this->db->join("pdf_table as liability_table","liability_table.pdf_id=liability.pdf_id","left");
		$this->db->group_start();
		$this->db->like('company.company_name',$phrase);
		$this->db->group_end();
		$this->db->group_by("company.company_name");
		$this->db->group_by("liability.set_id");
		$query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result();
	}
}