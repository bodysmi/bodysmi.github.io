<?php

if($_POST['id'] === "popup-form-form") {
	require_once 'smtp/PHPMailerAutoload.php';

	$to = "oo.bykov@mail.ru"; // Your e-mail address here.

	$data_array = json_decode($_POST['data']);

	$body = "";
	foreach ($data_array as $key => $value) {
		if (isset($value->name) && $value->name !== "") {
			$body .= $value->name.': '.$value->value.'<br>';
		}
	}

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               	// Enable verbose debug output

	$mail->isSMTP();                                      	// Set mailer to use SMTP
	$mail->Host = "mail.hostland.ru";  		// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               	// Enable SMTP authentication
	$mail->Username = "main@kak-sozdat-online-kurs.ru";  // SMTP username
	$mail->Password = "XIOae3LYrv";  // SMTP password
	$mail->SMTPSecure = "tls";  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = "587";          // TCP port to connect to

	$mail->setFrom("main@kak-sozdat-online-kurs.ru");
	$mail->addAddress($to);     							// Add a recipient

	$mail->isHTML(true);                                  	// Set email format to HTML

	$mail->Subject = "";
	$mail->Body    = $body;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	foreach( $_FILES as $file) {
		if ( !move_uploaded_file( $file['tmp_name'], dirname(__FILE__) . '/../tmp/' . $file['name'] ) ) {
			echo "error upload file";
			continue;
		}

		$file_to_attach = dirname(__FILE__) . '/../tmp/' . $file['name'];
		$mail->AddAttachment( $file_to_attach , $file['name'] );
	}

	if(!$mail->send()) {
		header("HTTP/1.1 406 Not Acceptable");
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}
}