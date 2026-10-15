<?php

declare(strict_types=1);

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

// Configure session before any output
ini_set('session.save_path', __DIR__ . '/../runtime/sessions');
ini_set('session.use_cookies', '0');
ini_set('session.use_only_cookies', '0');

require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../vendor/autoload.php';
