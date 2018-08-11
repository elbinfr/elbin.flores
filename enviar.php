<?php 

require("phpmailer/class.phpmailer.php"); // Requiere PHPMAILER para poder enviar el formulario desde el SMTP de google
include("phpmailer/class.smtp.php");


	$nombre = $_POST['nombre'];
	$remitente = $_POST['correo'];
	$mensaje = $_POST['mensaje'];

	//*******************************************************
	 
    $mail = new PHPMailer();

    $mail->From     = $remitente;
    $mail->FromName = $nombre; 
    $mail->AddAddress("elbinfr.88@gmail.com"); // Dirección a la que llegaran los mensajes.

	// Aquí van los datos que apareceran en el correo que reciba

    $mail->WordWrap = 50; 
    $mail->IsHTML(true);     
    $mail->Subject  =  "Contacto"; // Asunto del mensaje.
    $mail->Body     =  "Nombre: $nombre \n<br />". // Nombre del usuario
    "Email: $remitente \n<br />".    // Email del usuario
    "Mensaje: $mensaje \n<br />"; // Mensaje del usuario

	// Datos del servidor SMTP, podemos usar el de Google, Outlook, etc...

    $mail->IsSMTP();
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = "tls";
    $mail->SMTPDebug = 1;
    $mail->Host = "smtp.mailgun.org";  // Servidor de Salida. 465 es uno de los puertos que usa Google para su servidor SMTP 
    $mail->Port       = 587;
    $mail->Username = "postmaster@sandboxd4e8814039d147378baaca38fe46080f.mailgun.org";  // Correo Electrónico
    $mail->Password = "36b7c738cea9f616d9409d448e811008"; // Contraseña del correo

    if ($mail->Send()){
    	$respuesta = "ok";
    }else{
    	$
    	$respuesta = "error";
    }

    $resultado = array(
    	'respuesta' => $respuesta, 
    );

    echo json_encode($resultado);

?>