<?php
require 'vendor/autoload.php';
use Midtrans\Config;
echo class_exists(Config::class) ? 'Exists' : 'Not found';
