<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Search</title>

	<style type="text/css">
	</style>
	<style></style>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script scr="js/bootstrap.min.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div id="container">
	<h1>Welcome to search!</h1>

	<div id="body">
		<input type="text" id="search" name="search" onkeyup="search_details(this.value);">
		<div class="table-responsive">          
		  <table class="table">
		    <thead>
		      <tr>
		        <th>Company Name</th>
		        <th>Language</th>
		        <th>liability</th>
		        <th>Property</th>
		        <th>E_O</th>
		        <th>Excess</th>
		        <th>Umbrella</th>
		      </tr>
		    </thead>
		    <tbody id='search_results'>
		    </tbody>
		  </table>
  		</div>
	</div>
</div>
<script>
	$(function(){

	});

	function search_details(value) {
		var data = {};
		var d = $.Deferred();
		data['search_phrase'] = value;
		$.ajax({
			url:'Search/search_ajax',
			type:'POST',
			data:data,
			success:function(json) {
				$('#search_results').empty();
				$('#search_results').append(json.html);
				d.resolve();
			}
		});
		$.when(d).then(function(){
			console.log('json was success');
		});
	}

</script>
</body>
</html>