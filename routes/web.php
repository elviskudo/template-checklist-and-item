<?php

use \Illuminate\Http\Request;

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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/users', 'ExampleController@index');

$router->group(['prefix' => 'api/v1/checklists'], function () use ($router) {
    // group of templates
    $router->get('templates', 'TemplateController@index');
    $router->post('templates', 'TemplateController@store');
    $router->get('templates/{templateId}', 'TemplateController@show');
    $router->patch('templates/{templateId}', 'TemplateController@store');
    $router->delete('templates/{templateId}', 'TemplateController@destroy');
    $router->post('templates/{templateId}/assigns', 'TemplateController@assign');

    // group of items
    $router->post('complete', 'ItemController@complete');
    $router->post('incomplete', 'ItemController@incomplete');
    $router->get('/{checklistId}/items', 'ItemController@show');
    $router->post('/{checklistId}/items', 'ItemController@store');
    $router->get('/{checklistId}/items/{itemId}', 'ItemController@item');
    $router->patch('/{checklistId}/items/{itemId}', 'ItemController@addItem');
    $router->delete('/{checklistId}/items/{itemId}', 'ItemController@destroy');
    $router->post('/{checklistId}/items/_bulk', 'ItemController@bulk');
    $router->get('items/summaries', 'ItemController@summaries');
    $router->get('items', 'ItemController@index');

    // group of histories
    $router->get('histories', 'HistoryController@index');
    $router->post('histories', 'HistoryController@store');
    $router->get('histories/{historyId}', 'HistoryController@show');

    // group of checklist
    $router->get('/', 'ChecklistController@index');
    $router->get('/{checklistId}', 'ChecklistController@show');
    $router->patch('/{checklistId}', 'ChecklistController@store');
    $router->delete('/{checklistId}', 'ChecklistController@destroy');
    $router->post('/', 'ChecklistController@store');
});
