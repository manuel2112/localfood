<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOCALFOOD</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/jasny-bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="plugins/smooth/css/smoothDivScroll.css" />
	<link rel="stylesheet" href="style.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="css/mnu-mobile.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="css/interior.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="css/responsive.css?v=<?php echo time();?>">	
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-135462986-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-135462986-1');
	</script>
</head>

<body>

<header>
	<div class="container border-bottom">
		<div class="row">
			<div class="col-12 col-md-2">
				<a href="index"><img src="images/logo.png" class="img-fluid mx-auto d-block logo" alt=""></a>
			</div>
			<nav class="col-12 col-md-10">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link" href="cliente/" target="_blank">Acceso Clientes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="politicas">Políticas de Privacidad</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link" data-toggle="modal" data-target="#mdlContacto">Contacto</a>
					</li>
				</ul>				
			</nav>
		</div>
	</div>
</header>
	
<?php include("mdl-contacto.php"); ?>