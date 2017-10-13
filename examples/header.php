<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Podio udvidet tilmeldingsformular</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/advanced-webform.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="../assets/js/advanced-webform.js"></script>
	</head>
<body style = "width:100%;">
	
	<div style = "width: 400px; margin: 0 auto;" id="main" class="container">
		<div class="row">
			<div class="span12">
				<?php $title = (isset($title)) ? $title : 'Podio udvidet tilmeldingsform'; ?>
				<h1><?php echo $title; ?></h1>
			</div>
		</div>
		
		<?php if (isset($error_message)){ ?>
			<div class="row">
				<div class="span12">
					<div class="alert alert-error"><?php echo $error_message; ?></div>
				</div>
			</div>
		<?php }if (isset($message)){ ?>
			<div class="row">
				<div class="span12">
					<div class="alert alert-success"><?php echo $message; ?></div>
				</div>
			</div>
		<?php }