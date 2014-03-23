<?php
require 'config.php';

use Respect\Rest\Router;

$r3 = new Router;

$r3->get('/', function() {
  return 'Hello, World';
});

$r3->always('Accept', array(
  'application/json' => 'json_encode'
));

$r3->any('/blog/*', 'SampleBlog\BlogController');
