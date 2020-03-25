<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$config = array(
		'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
		'smtp_host' => 'ssl://smtp.googlemail.com', 
		'smtp_port' =>  465,
		'smtp_user' => 'melico.alladin@gmail.com',
		'smtp_pass' => 'melicoako09195586014amm',
		'smtp_from_name' => 'Student Resource Information',
		'newline' => "\r\n",
		// 'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
		'mailtype' => 'text', //plaintext 'text' mails or 'html'
		'charset' => 'utf-8',
		'wordwrap' => TRUE
	);
//extension=php_openssl.dll
