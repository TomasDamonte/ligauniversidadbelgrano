<?php

require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer();
@$nombre = addslashes($_POST["nombre"]);
@$apellido = addslashes($_POST["apellido"]);
@$email = addslashes($_POST['email']);
@$motivo = addslashes($_POST['motivoMensaje']);
@$mensaje = addslashes($_POST['mensaje']);

if ($motivo=="1"){
	$smotivo="Consulta";
}elseif ($motivo=="2") {
	$smotivo="Sugerencia";
}else{
	$smotivo="Queja";
}
//Luego tenemos que iniciar la validación por SMTP:
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';

$mail->Host = "smtp.gmail.com"; // A RELLENAR. Aquí pondremos el SMTP a utilizar. Por ej. mail.midominio.com
$mail->Username = "ub.comunidad.torneo@gmail.com"; // A RELLENAR. Email de la cuenta de correo. ej.info@midominio.com La cuenta de correo debe ser creada previamente. 
$mail->Password = "torneo2017"; // A RELLENAR. Aqui pondremos la contraseña de la cuenta de correo
$mail->Port = 587; // Puerto de conexión al servidor de envio. 
$mail->From = "ub.comunidad.torneo@gmail.com"; // A RELLENARDesde donde enviamos (Para mostrar). Puede ser el mismo que el email creado previamente.
$mail->FromName = "Torneo Comunidad UB"; //A RELLENAR Nombre a mostrar del remitente. 
$mail->AddAddress("ub.comunidad.torneo@gmail.com"); // Esta es la dirección a donde enviamos 
$mail->IsHTML(true); // El correo se envía como HTML 
$mail->Subject = "Mensaje desde la pagina LigaUB"; // Este es el titulo del email. 
$body = "<h1>$smotivo de Pagina Web LigaUB</h1>"; 
$body .= "<h3>Nombre: </h3>$nombre </br>"; 
$body .= "<h3>Apellido: </h3>$apellido</br>"; 
$body .= "<h3>Email: </h3>$email</br>"; 
$body .= "<h3>Motivo: </h3>$smotivo</br>"; 
$body .= "<h3>Mensaje: </h3><strong>$mensaje</strong></br>";
$mail->Body = $body; // Mensaje a enviar. 
$exito = $mail->Send(); // Envía el correo.
if($exito){ 
	echo "<script language='javascript'>
	alert('Mensaje enviado, le estaremos contestando a su correo. Muchas gracias!!!');
	window.location.href = '../index.html';
	</script>";
}else{
	//Si el mensaje no se envía muestra el mensaje de error
	die("Error: Su mensaje no se pudo enviar, intente más tarde");
	echo "<script language='javascript'>
	alert('ERROR: No se pudo enviar el mensaje, intente mas tarde');
	window.location.href = '../index.html';
	</script>";
} 
?>