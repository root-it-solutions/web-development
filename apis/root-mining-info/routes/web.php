<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use v1\CryptoAssets;

$router->get('/', function () use ($router) {
    return 'API Documentation';
});

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('/ping', function () {
        return response()->json(['ack' => time()],
            200,
            ['content-type' => 'application/vnd.api+json']
        );
    });
    $router->get('cryptoAssets', function () {
        return response()->json(
            (new CryptoAssets)->showCryptoAssetsBalances(),
            200,
            ['content-type' => 'application/vnd.api+json']
        );
//            return json_encode((new CryptoAssets)->showCryptoAssets());
    });
    $router->get('cryptoAssets/coinListForZabbixDiscovery', function () {
        return response()->json(
            (new CryptoAssets)->showCryptoAssetsCoinListForZabbixDiscovery(),
            200,
            ['content-type' => 'application/vnd.api+json']
        );
//            return json_encode((new CryptoAssets)->showCryptoAssets());
    });

//    $router->get('cryptoAssets/{coin}', ['uses' => 'CryptoAssets@showCrtyptoAssetsPerCoin']);

}); //$router->group(['prefix' => 'v1'], function () use ($router) {
