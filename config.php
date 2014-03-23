<?php
require 'vendor/autoload.php';

$connections = array(
  'default' => sprintf('mysql://%s:%s@%s/%s', 'root', 'media1', 'localhost', 'blog')
);

\ActiveRecord\Connection::$PDO_OPTIONS[PDO::ATTR_PERSISTENT] = true;
$cfg = \ActiveRecord\Config::instance();
$cfg->set_model_directory(__DIR__ . '/lib/SampleBlog/models');
$cfg->set_connections($connections);
$cfg->set_default_connection('default');
