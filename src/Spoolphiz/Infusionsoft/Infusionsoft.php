<?php
namespace Spoolphiz\Infusionsoft;
use \Config;
//use Spoolphiz\Infusionsoft\iSDK;
/*
This is hackish and a un-laravel way to handle the requirement of \iSDK but unfortunately the xmlrpc3.0 lib doesn't want to correctly encode values when run with a namespace. Will try to resolve this later. (Or maybe Infusionsoft will implement a proper RESTful API without the xmlrpc dependency)
*/
require_once(__DIR__.'/isdk.php');

//class Infusionsoft extends \iSDK {
class Infusionsoft {
	
	/**
	 * Instantiates the SDK class
	 * 
	 * @return \iSDK object
	 */
	public static function sdk()
	{	
		//get config values for app name and api key
		$appName =  Config::get('infusionsoft::appName');
		$apiKey =  Config::get('infusionsoft::apiKey');
		
		$app = new \iSDK;
		$app->cfgCon($appName, $apiKey);
		
		return $app;
	}
	
	 /**
	 * Executes the requested Infusionsoft SDK method with the supplied args.
	 * 
	 * @param $sdk		\iSDK - the iSDK object
	 * @param $method	string - the SDK method to run
	 * @param $args		array - array with numerical keys containing args to be passed to \iSDK::$method
	 * @param $log		bool - toggles database logging of execution time for each SDK method called. This
	 *							is currently not available and will be coming shortly in a future release.
	 *
	 * @return array
	 */
	public static function execWithLog( $sdk, $method, $args, $log = false )
	{
		//TODO: implement logging functionality
		//For now this function just calls requested iSDK method
		//and is intended as a placehodlder in case you want to 
		//write code in such a way that will allow logging in the future 
		//without requiring modification
		
		//$start = microtime(true);
		$result = call_user_func_array(array($sdk, $method), $args);
		//$end = microtime(true);
		
		/*$logData = array_merge( array(
									'type' => $_SERVER['REQUEST_METHOD'],
									'request' => $_SERVER['REQUEST_URI'],
									)
									, $args);
		$name = "ifs.$method"
		$execTime = $end - $start;*/
		
		return $result;
	}
}
