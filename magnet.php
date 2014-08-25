<?php
// Lib classed autoloading
require 'vendor/autoload.php';

use TvMagnet\TvMagnetApplication;

$app = new TvMagnetApplication();

$status = $app->run();
