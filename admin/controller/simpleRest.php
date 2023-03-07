<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class SimpleRest
{
	public function decode_json($json_str)
	{
		$res_data = json_decode($json_str, true);
		return $res_data;
	}
	public function encode_json($res_data)
	{
		$json_res = json_encode($res_data);
		return $json_res;
	}
	public function validateToken($token)
	{
		$secret_key = "hello";
		$token = substr($token, 7);
		try {
			$decoded = JWT::decode($token, new Key($secret_key, 'HS512'));
			$decoded_array = (array) $decoded;
			return $decoded_array;
		} catch (Exception $e) {
			return false;
		}
	}

	// validate token from header
	private $http_version = "HTTP/1.1";
	public function setHttpHeaders($status_code, $method)
	{
		// set header status to json only
		$status_message = $this->getHttpstatus_msg($status_code);
		header($this->http_version . " " . $status_code . " " . $status_message);
		//set method 
		header("Access-Control-Allow-Methods: " . $method . "");
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	}
	public function getHttpstatus_msg($status_code)
	{
		$httpStatus = array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => '(Unused)',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported'
		);
		return ($httpStatus[$status_code]) ? $httpStatus[$status_code] : $status_code[500];
	}

	//take auth token from header and validate it 
	// public function validateHeader($token)
	// {
	// 	$token = substr($token, 7);
	// 	$decoded = $this->validateToken($token);
	// 	return $decoded;
	// }

	// public function validateHeaderAdmin($token)
	// {
	// 	$token = substr($token, 7);
	// 	$decoded = $this->validateToken($token);
	// 	if ($decoded['role'] === '1') {
	// 		return $decoded;
	// 	} else {
	// 		return false;
	// 	}
	// }
}
