<?php
/**
* json View
*
* @package 		Ajax
* @author 		Andrew Zhao
* @copyright 	Copyright (c) 2018
*/
defined('BASEPATH') OR exit('No direct script access allowed');

$html = '';

foreach ($result as $company_id) {
	# code...
	$html .= "<tr>
				<td>".$company_id['company_name']."</td>
				<td>".$company_id['lang']."</td>
				<td>".$company_id['liability_pdf']."</td>
				<td>".$company_id['property_pdf']."</td>
				<td>".$company_id['e_o_pdf']."</td>
				<td>".$company_id['excess_pdf']."</td>
				<td>".$company_id['umbrella_pdf']."</td>	
			</tr>";
}




$json = array();
$json['html'] = $html;
if (isset($css))
	$json['css'] = $css;
if (isset($jquery))
	$json['jquery'] = $jquery;
if (isset($key_value))
	$json['key_value'] = $key_value;
$json['session'] = true;
$json['error'] = array();

header('Content-Type: application/json;charset=utf-8');
echo json_encode($json);
?>