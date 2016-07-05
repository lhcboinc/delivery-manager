<?php namespace DeliveryManager\ServiceProvider;

use Illuminate\Support\ServiceProvider;



class DeliveryManagerServiceProvider extends ServiceProvider {
    
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;
        

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{           
       
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{

        /*    $this->app->bind('DeliveryManager', function($app)
		{
			return new \DeliveryManager\DeliveryManager();
		});*/

           $this->app->bind('DeliveryManager', 'DeliveryManager\DeliveryManager');  
            
	}  
        
        

        
        

}
