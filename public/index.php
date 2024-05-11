<?php

header("Location: https://forms.gle/J8em6CcDtU51ifiS8");
exit();

chdir(dirname(__DIR__));

// Composer autoloading
include __DIR__ . '/../vendor/autoload.php';

// Retrieve configuration
$appConfig = require __DIR__ . '/../config/application.config.php';

// Run the application!
\Laminas\Mvc\Application::init($appConfig)->run();
