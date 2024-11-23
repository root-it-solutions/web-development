<?php

if ($_SERVER['REMOTE_ADDR'] === '185.55.75.180')
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
/*
 * Error: Call to undefined function ccxt\mb_split()
 * Extension as to be in the correct order
 * extension=mbstring.so
 * extension=exif.so
 * restart apache
 */
/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|

*/

use Illuminate\Http\Request;

$app = require __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/
//$request = Request::capture();
$app->run();
//$app->run($app->request);
