<?php

Dotenv::load(__DIR__, '../.env');

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
    'driver'    =>  'mysql',
    'host'      =>  'localhost',
    'database'  =>  'domains',
    'username'  =>  getenv('DB_USERNAME'),
    'password'  =>  getenv('DB_PASSWORD'),
    'charset'   =>  'utf8',
    'collation' =>  'utf8_unicode_ci',
    'prefix'    =>  ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();