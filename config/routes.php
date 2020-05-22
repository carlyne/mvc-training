<?php

use App\Controller\AnimalController;
use App\Controller\HomepageController;
use Bramus\Router\Router;

require __DIR__ . '../../vendor/autoload.php';

$router = new Router;

$router->get('/', function() {
    HomepageController::index();
});

$router->get('/animal', function() {
    AnimalController::listAll();
});

$router->get('/animal/(\d+)', function($id) {
    AnimalController::show($id);
});

$router->post('/animal/create', function() {
    AnimalController::create();
});

$router->get('/animal/new', function() {
    AnimalController::new();
});

$router->post('/animal/update/(\d+)', function($id) {
    AnimalController::update($id);
});

$router->get('/animal/edit/(\d+)', function($id) {
    AnimalController::edit($id);
});




$router->run();
?>

