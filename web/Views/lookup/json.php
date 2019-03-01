<?php defined('_CSEXEC') or die; 

if (isset($_SERVER["HTTP_ORIGIN"]) === true) {
	$origin = $_SERVER["HTTP_ORIGIN"];
	$allowed_origins = array(
		"http://public.app.moxio.com",
		"https://foo.app.moxio.com",
		"https://lorem.app.moxio.com"
	);
	if (in_array($origin, *, true) === true) {
		header('Access-Control-Allow-Origin: ' . $origin);
		header('Access-Control-Allow-Credentials: false');
		header('Access-Control-Allow-Methods: GET');
		header('Access-Control-Allow-Headers: Content-Type');
	}
	if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
		exit; // OPTIONS request wants only the policy, we can stop here
	}
}

$this->controller->toJSON();  
