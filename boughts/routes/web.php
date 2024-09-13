<?php

Route::namespace('Dashboard')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('/getData', 'DashboardController@getData')->name('getData');

    });


Auth::routes(['verify' => true]);

Route::prefix('admin')
    ->namespace('Admin')
    ->name('admin.')
    ->middleware(['auth','profile:Administrator'])
    ->group(function() {
        Route::resource('users','UsersController')->only(['index','create','store','delete']);
        Route::get('getUsers','UsersController@getUsers')->name('users.getUsers');
        Route::patch('users/{user}/trash','UsersController@trash')->name('users.trash');
    });

Route::middleware(['auth'])
    ->group(function() {
        Route::resource('users','UsersController')->only(['show','edit','update']);
    });


Route::prefix('catalog')
    ->namespace('Catalog')
    ->name('catalog.')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/','SkuDataController@index')->name('index');
        Route::get('/{sku}/edit/{column}','SkuDataController@edit')->name('edit');
        Route::get('getData','SkuDataController@getData')->name('getData');
        Route::get('getQtyUSBinStockData/{sku}','SkuDataController@getQtyUSBinStockData')->name('getQtyUSBinStockData');
        Route::get('getQtyUSBinHistoryData/{sku}','SkuDataController@getQtyUSBinHistoryData')->name('getQtyUSBinHistoryData');
        Route::get('getQtyEUBinStockData/{sku}','SkuDataController@getQtyEUBinStockData')->name('getQtyEUBinStockData');
        Route::get('getQtyEUBinHistoryData/{sku}','SkuDataController@getQtyEUBinHistoryData')->name('getQtyEUBinHistoryData');
        Route::put('/{sku}','SkuDataController@update')->name('update');
        Route::put('/newPrices/{sku}','SkuDataController@updateNewPrices')->name('updateNewPrices');
        Route::put('/cnPrices/{sku}','SkuDataController@updateCNPrices')->name('updateCNPrices');
        Route::put('/usedPrices/{sku}','SkuDataController@updateUsedPrices')->name('updateUsedPrices');
        Route::put('/haveCnVariant/{sku}','SkuDataController@updateHaveCnVariant')->name('updateHaveCnVariant');
        Route::get('/create','SkuDataController@create')->name('create');
        Route::post('/','SkuDataController@store')->name('store');
        Route::get('/{sku}','ImagesController@show')->name('images.show');
        Route::delete('/{sku}','SkuDataController@destroy')->name('delete');
        Route::post('/cleanTxt','SkuDataController@cleanTxt')->name('cleanTxt');
        Route::post('/compareText/{sku}','SkuDataController@compareText')->name('compareText');
        //Route::get('/inventory','SkuDataController@inventory')->name('inventory');
        //Route::get('/getSku','SkuDataController@getSku')->name('getSku');
    });

Route::prefix('inventory')
    ->namespace('Inventory')
    ->name('inventory.')
    ->middleware(['auth'])
    ->group(function() {
        Route::resource('/','GlobalController')->only(['index','create','store']);
        Route::get('getData','GlobalController@getData')->name('getData');
    });


Route::prefix('clean')
    ->namespace('CleanLaunch')
    ->name('clean.')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/','CleanLaunchController@index')->name('index');
        Route::get('/getData','CleanLaunchController@getData')->name('getData');
        Route::get('/getSku','CleanLaunchController@getSku')->name('getSku');
        Route::get('/getBrand','CleanLaunchController@getBrand')->name('getBrand');
        Route::get('/getPartNumber','CleanLaunchController@getPartNumber')->name('getPartNumber');
        Route::get('/{sku}','CleanLaunchController@show')->name('show');
        Route::post('/','CleanLaunchController@store')->name('store');
        Route::put('/{clean}','CleanLaunchController@update')->name('update');
        Route::delete('/{clean}','CleanLaunchController@destroy')->name('destroy');
    });



Route::prefix('images')
    ->namespace('Catalog')
    ->name('image.')
    ->middleware(['auth'])
    ->group(function() {
        Route::post('/','ImagesController@store')->name('store');
        Route::put('/{image}','ImagesController@update')->name('update');
        Route::delete('/{image}','ImagesController@destroy')->name('delete');
    });

Route::prefix('action')
    ->namespace('Catalog')
    ->name('action.')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('launchInv','ActionsController@launchInv')->name('launchInv');
        Route::get('/update/inventory','ActionsController@inventory')->name('update.inventory');
        Route::get('/update/repricer','ActionsController@repricer')->name('update.repricer');
    });



Route::prefix('market')
    ->namespace('Market')
    ->name('market.')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/','MarketPlaceController@index')->name('index');
        Route::get('getData','MarketPlaceController@getData')->name('getData');
        Route::get('/create','MarketPlaceController@create')->name('create');
        Route::post('/','MarketPlaceController@store')->name('store');
        Route::get('/{mkt}/edit','MarketPlaceController@edit')->name('edit');
        Route::put('/{mkt?}','MarketPlaceController@update')->name('update');
        Route::delete('/{mkt}','MarketPlaceController@destroy')->name('delete');
        Route::get('getMS/{mkt}','MarketPlaceController@getMS')->name('getMS');

        Route::put('/fulfillment/{mkt}','FulfillmentTypeController@update')->name('fulfillment');
        Route::put('/floor/{mkt}','FloorController@update')->name('floor');
        Route::put('/ceiling/{mkt}','CeilingController@update')->name('ceiling');
        Route::put('/isSnl/{mkt}','IsSnLController@update')->name('isSnL');
        Route::get('/updateInv','UpdateInvController@index')->name('updateInv');
        Route::get('/launch','LaunchController@index')->name('launch');
        Route::post('/updateBulkPrice','MarketPlaceController@updateBulkPrice')->name('updateBulkPrice');
        Route::post('/deleteBulkPrice','MarketPlaceController@deleteBulkPrice')->name('deleteBulkPrice');

    });


Route::prefix('shipStation')
    ->namespace('Updates')
    ->name('shipStation.')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/productImport','ShipStationController@productImport')->name('productImport');
        Route::get('/aliasImport','ShipStationController@aliasImport')->name('aliasImport');
    });


