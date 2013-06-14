<?php 
namespace Spoolphiz\Infusionsoft;

use Illuminate\Support\ServiceProvider;
use Spoolphiz\Infusionsoft\Infusionsoft;

class InfusionsoftServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;
	
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('spoolphiz/infusionsoft');
		
		//Config::package('spoolphiz/infusionsoft', __DIR__.'/../../../config');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//load config file for package
		//$this->app['config']->package('spoolphiz/infusionsoft', __DIR__.'/../../../config', 'spoolphiz/infusionsoft');
		
		// Register 'infusionsoft' instance container to our Infusionsoft object
		$this->app['infusionsoft'] = $this->app->share(function($app)
		{
			return new \Spoolphiz\Infusionsoft\Infusionsoft;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('infusionsoft');
	}

}