<?php
	
	$nombre    		= trim($_POST["nombre"]);
	$email     		= trim($_POST["email"]);
	$mensaje  		= trim($_POST["mensaje"]);
		
	$error = "";	
	if( $nombre == '' ){
		$error .= '* Nombre obligatorio<br />';
	}
	
	if( $email == '' ){
		$error .= '* Email obligatorio<br />';
	}
	
	if( $email != '' && !filter_var($email,FILTER_VALIDATE_EMAIL) ){
		$error .= '* Email no Válido<br />';
	}
	
	if( $mensaje == '' ){
		$error .= '* Mensaje obligatorio<br />';
	}
	
	if( $error != '' ){
		echo '<div class="col-xs-12 alert alert-danger text-center" role="alert"><strong>ALERTA!!!<br /></strong>'.$error.'</div>';
	}else{
					
		$body = "<table border='1'>
					  <tr><td>Nombre</td><td>".$nombre."</td></tr>
					  <tr><td>Email</td><td>".$email."</td></tr>
					  <tr><td>Mensaje</td><td>".$mensaje."</td></tr>
					</table>";		

		require_once('../phpmailer/class.phpmailer.php'); 
		$mail = new PHPMailer();
		//$mail->IsSMTP();
		$mail->CharSet  = "UTF-8";
		$mail->Host		= "mail.localfood.cl";
		$mail->SMTPAuth = true;
		$mail->Username = "contacto@localfood.cl";
		$mail->Password = "c3Kqo{rGjEt7";
		$mail->Port 	= 465;
		$mail->From		= $email;
		$mail->FromName	= $nombre;
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->AddAddress('contacto@localfood.cl');
		$mail->AddBCC('manuel2112@hotmail.com');
		$mail->Subject	= 'LocalFood - Formulario de Contacto';
		$mail->Body    	= $body;
		$mail->AltBody 	= "Favor configurar su correo para leer HTML.";
		$mail->Send();
		
		echo '';
	}	
?>