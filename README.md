PHP iSDK for Laravel 4
==================
This is a port of [Infusionsoft's PHP SDK](https://github.com/infusionsoft/PHP-iSDK) to Laravel 4 inspired by a [similar project](https://github.com/tshafer/Infusionsoft-for-Laravel-4/tree/master/src/Chrono/Infusionsoft) created by [tshafer](https://github.com/tshafer).

Motivation
==================
Infusionsoft's API is business critical and being a control freak I wanted to take ownership over merging in future updates. I'll also be writing a db based logging system to track execution time on a per API call basis.

Install Instructions
==================
Install the package using composer (by adding the require entry into your app's composer.json file) and add the following entry to the array of service providers found in app/config/app.php:

`'Spoolphiz\Infusionsoft\InfusionsoftServiceProvider'`

Usage
==================
Add the following to your app/routes.php and visit http://www.yourdomain.com/infusionsoft-test

```php
Route::get('/infusionsoft-test', function()
{
	$ifs = new Spoolphiz\Infusionsoft\Infusionsoft('ls');
	$contactId = 123456;
	$result = $ifs->loadCon($contactId, array('FirstName','LastName','Email'));
	
	dd($result);
});
```

The `Spoolphiz\Infusionsoft\Infusionsoft` class extends Infusionsoft's iSDK class so you can run any API method against it. 