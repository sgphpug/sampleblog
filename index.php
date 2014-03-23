<?php
require 'vendor/autoload.php';

use Respect\Rest\Router;

$r3 = new Router;

$r3->get('/', function() {
  return 'Hello, World';
});

$r3->always('Accept', array(
  'application/json' => 'json_encode'
));

$r3->get('/blog', function() {
  return array( 'message' => 'Listing all posts', 'data'=> array() );
});