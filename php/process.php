<?php

require_once('phpmailer/vendor/autoload.php');
require_once('validator/gump.class.php');
require_once('db/connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$data = $_POST;
$response = array(
	'success' => false,
	'errors' => array(
		'code' => 404,
		'message' => 'Error Processing Request'
	),
	'data' => array()
);

try {
	if (empty($data)) {
		throw new Exception('Error Processing Request', 404);
	}

	$validator = new GUMP('es');

	$_POST = $validator->sanitize($_POST);

	$validator->validation_rules(array(
		'name'    	=> 'required|alpha_numeric|max_len,100|min_len,6',
		'email'   	=> 'required|valid_email',
		'company'	=> 'required',
	));

	$validator->filter_rules(array(
		'name' 		=> 'trim|sanitize_string',
		'email'    	=> 'trim|sanitize_email',
		'company'   => 'trim',
		
	));

	$validatedData = $validator->run($_POST);

	if(!$validatedData) {
		throw new Exception($validator->get_readable_errors(true), 404);
	} else {

		$insertData = $db->insert('users', [
		    'name' => $validatedData['name'],
		    'email' => $validatedData['email'],
		    'company' => $validatedData['company'],
		    'date' => date('Y-m-d H:i:s')
		]);

		if ($insertData) {
			$mail = new PHPMailer(true);
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'mail@mai.com';
			$mail->Password = 'secret';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;
			$mail->setFrom('no.reply.service.mail.16@gmail.com', 'Mailer');
			$mail->addAddress($validatedData['email'], $validatedData['name']);
			$mail->isHTML(true);
			$mail->Subject = 'Gracias por tu registro';
			$mail->Body    = '<b>Gracias por tu registro</b>';
			$mail->AltBody = 'Gracias por tu registro';
			
			if ($mail->send()) {
				$response = array(
					'success' => true,
					'errors' => array(
						'code' => 200,
						'message' => 'Registro completo'
					),
					'data' => array()
				);
			}
		} else {
			throw new Exception('Ocurrió un error al guardar la información', 404);
		}
	}	
} catch(Exception $e) {
	$response = array(
		'success' => false,
		'errors' => array(
			'code' => $e->getCode(),
			'message' => $e->getMessage()
		),
		'data' => array()
	);
} finally {
	echo json_encode($response);
}