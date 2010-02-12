<?php
$path = realpath(dirname(__FILE__).'/..');
require_once $path.'/bootstrap/unit.php';

$h = new lime_harness(new lime_output_color());
$h->base_dir = $path;

$h->register(sfFinder::type('file')->name('*Test.php')->in($h->base_dir));

exit($h->run() ? 0 : 1);
