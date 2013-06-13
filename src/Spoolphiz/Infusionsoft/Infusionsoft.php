<?php
namespace Spoolphiz\Infusionsoft;

//use Spoolphiz\Infusionsoft\iSDK;
/*
This is hackish and a un-laravel way to handle the requirement of \iSDK but unfortunately the xmlrpc3.0 lib doesn't want to correctly encode values when run with a namespace. Will try to resolve this later. (Or maybe Infusionsoft will implement a proper RESTful API without stupid dependencies)
*/
require_once(__DIR__.'/isdk.php');

class Infusionsoft extends \iSDK {
	
	protected $_app;
	
	/**
	* Init the sdk
	* 
	*/
	public function __construct( $connectionName )
	{
		//$defaultConnection = Config::get('infusionsoft::defaultConnection');
		//dd($defaultConnection);
		
		$this->_app = parent::cfgCon($connectionName);
	}
	
	public function test()
	{
		dd('works');
	}
}
