
<style>
	.pdfobject-container { height: 80rem; width: 70rem; }
</style>

<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<div class="row">
				<h3><?=$file['title']?></h3>
				<a href="" class="btn btn-info">Update</a>
				<?php
					echo form_open('file/show');
					echo form_hidden('idFile',$file['idFile']);
					echo form_hidden('idActivity',$this->uri->segment(3));
					$data = array('name'=>'createActor',
						'type' => 'submit',
						'value'=>'Delete',
						'class'=>'btn btn-danger');
					echo form_submit($data);
					echo form_close();
				?>
			</div>
			<p><?=$file['file_description']?></p>
		</div>
		<div id="document" class="col">	
		</div>
	</div>
</div>

<?php
	$parser = new \Smalot\PdfParser\Parser();
	$pdf    = $parser->parseFile(base_url().$file['source']);
 
	$text = substr($pdf->getText(),0,5100) ;
	$details  = $pdf->getDetails();
	$pdfDetails = array();
	foreach ($details as $property => $value) {
		if (is_array($value)) {
			$value = implode(', ', $value);
		}
		$pdfDetails[$property] = $value;
		// echo $property . ' => ' . $value . "\n";
	}

	print_r($pdfDetails);
	// echo $text;
?>

<script src="<?=base_url()?>node_modules/pdfobject/pdfobject.js"></script>
<script>PDFObject.embed("<?=base_url()?><?=$file['source']?>", "#document");</script>


<?php

	// // NOTE: Be sure to uncomment the following line in your php.ini file.
	// // ;extension=php_openssl.dll
	// // You might need to set the full path, for example:
	// // extension="C:\Program Files\Php\ext\php_openssl.dll"
	// $subscription_key = "46a7958b0b424bc0aeeae8f9592d51ab";
	// $endpoint = "https://svnhs-is.cognitiveservices.azure.com/";

	// // LANGUAGE ANALYSIS
	// $path = '/text/analytics/v2.1/languages';

	// function DetectLanguage ($host, $path, $key, $data) {

	// 	$headers = "Content-type: text/json\r\n" .
	// 		"Ocp-Apim-Subscription-Key: $key\r\n";

	// 	$data = json_encode ($data);

	// 	$options = array (
	// 		'http' => array (
	// 			'header' => $headers,
	// 			'method' => 'POST',
	// 			'content' => $data
	// 		)
	// 	);
	// 	$context  = stream_context_create ($options);
	// 	$result = file_get_contents ($host . $path, false, $context);
	// 	return $result;
	// }

	// $data = array (
	// 	'documents' => array (
	// 		array ( 'id' => '1', 'text' => $text )
	// 	)
	// );

	// print "Please wait a moment for the results to appear.";

	// $result = DetectLanguage ($endpoint, $path, $subscription_key, $data);

	// echo "<pre>";
	// echo json_encode (json_decode ($result), JSON_PRETTY_PRINT);
	// echo "</pre>";


	// // SENTIMENT ANALYSIS
	// $path = '/text/analytics/v2.1/sentiment';

	// function GetSentiment ($host, $path, $key, $data) {
	// 	foreach ($data as &$item) {
	// 		foreach ($item as $ignore => &$value) {
	// 			$value['text'] = utf8_encode($value['text']);
	// 		}
	// 	}

	// 	$data = json_encode ($data);

	// 	$headers = "Content-type: text/json\r\n" .
	// 		"Content-Length: " . strlen($data) . "\r\n" .
	// 		"Ocp-Apim-Subscription-Key: $key\r\n";

	// 	$options = array (
	// 		'http' => array (
	// 			'header' => $headers,
	// 			'method' => 'POST',
	// 			'content' => $data
	// 		)
	// 	);
	// 	$context  = stream_context_create ($options);
	// 	$result = file_get_contents ($host . $path, false, $context);
	// 	return $result;
	// }

	// $data = array (
	// 	'documents' => array (
	// 		array ( 'id' => '1', 'language' => 'en', 'text' => $text ))
	// );

	// print "Please wait a moment for the results to appear.";

	// $result = GetSentiment($endpoint, $path, $subscription_key, $data);

	// echo "<pre>";
	// echo json_encode (json_decode ($result), JSON_PRETTY_PRINT);
	// echo "</pre>";


	// // KEY PHRASES ANALYSIS
	// $path = '/text/analytics/v2.1/keyPhrases';

	// function GetKeyPhrases ($host, $path, $key, $data) {

	// 	$headers = "Content-type: text/json\r\n" .
	// 		"Ocp-Apim-Subscription-Key: $key\r\n";

	// 	$data = json_encode ($data);
	// 	$options = array (
	// 		'http' => array (
	// 			'header' => $headers,
	// 			'method' => 'POST',
	// 			'content' => $data
	// 		)
	// 	);
	// 	$context  = stream_context_create ($options);
	// 	$result = file_get_contents ($host . $path, false, $context);
	// 	return $result;
	// }

	// $data = array (
	// 	'documents' => array (
	// 		array ( 'id' => '1', 'language' => 'en', 'text' => $text )
	// 	)
	// );

	// print "Please wait a moment for the results to appear.";

	// $result = GetKeyPhrases($endpoint, $path, $subscription_key, $data);

	// echo "<pre>";
	// echo json_encode (json_decode ($result), JSON_PRETTY_PRINT);
	// echo "</pre>";

	// // ENTITY ANALYSIS
	// $path = '/text/analytics/v2.1/entities';

	// function GetEntities ($host, $path, $key, $data) {

	// 	$headers = "Content-type: text/json\r\n" .
	// 		// "Content-Length: " . count($data,COUNT_NORMAL) . "\r\n" .
	// 		"Ocp-Apim-Subscription-Key: $key\r\n";
	// 	$data = json_encode ($data);
	// 	$options = array (
	// 		'http' => array (
	// 			'header' => $headers,
	// 			'method' => 'POST',
	// 			'content' => $data
	// 		)
	// 	);
	// 	$context  = stream_context_create ($options);
	// 	$result = file_get_contents ($host . $path, false, $context);
	// 	return $result;
	// }

	// $data = array (
	// 	'documents' => array (
	// 		array ( 'id' => '1', 'language' => 'en', 'text' => $text),
	// 	)
	// );

	// print "Please wait a moment for the results to appear.";

	// $result = GetEntities($endpoint, $path, $subscription_key, $data);

	// echo "<pre>";
	// echo json_encode (json_decode ($result), JSON_PRETTY_PRINT);
	// echo "</pre>";
?>
