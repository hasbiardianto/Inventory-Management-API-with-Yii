<?php

declare(strict_types=1);

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

// Start output buffering to prevent headers already sent error
ob_start();

// Configure session before any output
ini_set('session.save_path', __DIR__ . '/../runtime/sessions');
ini_set('session.use_cookies', '0');
ini_set('session.use_only_cookies', '0');
ini_set('session.cache_limiter', '');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$c3 = dirname(__DIR__) . '/c3.php';

if (file_exists($c3)) {
    require_once $c3;
}

$config = require __DIR__ . '/../config/test.php';

(new yii\web\Application($config))->run();
