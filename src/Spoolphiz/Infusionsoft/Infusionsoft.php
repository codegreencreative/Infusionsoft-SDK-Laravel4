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
	public static function execWithLog( $sdk, $method, $args, $log = true )
	{
		//TODO: implement logging functionality
		//For now this function just calls requested iSDK method
		//and is intended as a placehodlder in case you want to 
		//write code in such a way that will allow logging in the future 
		//without requiring modification
		
		$start = microtime(true);
		$result = static::wrap_call_user_func_array($sdk, $method, $args);
		$end = microtime(true);
		
		/*if( $log )
		{
			$logData = array_merge( array(
										'type' => $_SERVER['REQUEST_METHOD'],
										'request' => $_SERVER['REQUEST_URI'],
										)
										, $args);
			$name = "ifs.$method"
			$execTime = $end - $start;
		}*/
		
		return $result;
	}
	

	 /**
	 * Faster way of achieving functionality of call_user_func_array(), with fall back in case
	 * of too many params
	 * 
	 * @param $c	object - the object who's method we'll be calling
	 * @param $m	string - the method to call
	 * @param $p	array - array containing parameters to pass to specified function
	 *
	 * @return 		mixed
	 */
	public static function wrap_call_user_func_array($c, $m, $p) 
	{
		switch(count($p)) { 
			case 0: $result = $c->{$m}(); break; 
			case 1: $result = $c->{$m}($p[0]); break; 
			case 2: $result = $c->{$m}($p[0], $p[1]); break; 
			case 3: $result = $c->{$m}($p[0], $p[1], $p[2]); break; 
			case 4: $result = $c->{$m}($p[0], $p[1], $p[2], $p[3]); break; 
			case 5: $result = $c->{$m}($p[0], $p[1], $p[2], $p[3], $p[4]); break; 
			case 6: $result = $c->{$m}($p[0], $p[1], $p[2], $p[3], $p[4], $p[5]); break;
			case 7: $result = $c->{$m}($p[0], $p[1], $p[2], $p[3], $p[4], $p[5], $p[6]); break;
			case 8: $result = $c->{$m}($p[0], $p[1], $p[2], $p[3], $p[4], $p[5], $p[6], $p[7]); break;
			case 9: $result = $c->{$m}($p[0], $p[1], $p[2], $p[3], $p[4], $p[5], $p[6], $p[7], $p[8]); break;
			case 10: $result = $c->{$m}($p[0], $p[1], $p[2], $p[3], $p[4], $p[5], $p[6], $p[7], $p[8], $p[9]); break;
			default: $result = call_user_func_array(array($c, $m), $p);  break; 
		} 
		
		return $result;
	}
	
}
