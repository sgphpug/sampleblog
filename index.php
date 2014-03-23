<?php
require 'vendor/autoload.php';

use Respect\Rest\Router;

$r3 = new Router;

$r3->get('/', function() {
  return 'Hello, World';
});

$r3->get('/blog', function() {
  $payload = array( 'message' => 'Listing all posts', 'data'=> array() );
  return json_encode($payload);
});