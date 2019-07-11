<?php
/**
 *      Web routes
 */

$router->view('/', 'welcome');
$router->get('example', 'ExampleController@example');
$router->post('example', 'ExampleController@postExample');