<?php
require_once '../vendor/autoload.php';
spl_autoload_register(function ($className) {
    include_once '../'.$className . '.php';
});

use aqua\Kernel;

Kernel::boot();