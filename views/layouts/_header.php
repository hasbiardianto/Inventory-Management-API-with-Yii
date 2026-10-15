<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

$items = [
    [
        'label' => '🏠 Home',
        'url' => ['/site/index'],
    ],
    [
        'label' => '📡 API Endpoints',
        'url' => '#endpoints',
        'linkOptions' => ['onclick' => "document.getElementById('endpoints') ? document.getElementById('endpoints').scrollIntoView({behavior: 'smooth'}) : null; return false;"],
    ],
    [
        'label' => '📋 Fields',
        'url' => '#fields',
        'linkOptions' => ['onclick' => "document.getElementById('fields') ? document.getElementById('fields').scrollIntoView({behavior: 'smooth'}) : null; return false;"],
    ],
    [
        'label' => '📚 Documentation',
        'items' => [
            ['label' => 'API Documentation', 'url' => '/API_DOCUMENTATION.md'],
            ['label' => 'Quick Start Guide', 'url' => '/API_QUICKSTART.md'],
            ['label' => 'Testing Guide', 'url' => '/API_TESTING_GUIDE.md'],
        ],
    ],
];

?>
<header id="header">
    <?php NavBar::begin(
        [
            'brandLabel' => '📦 Inventory API',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
        ],
    ) ?>
    <?= Nav::widget(
        [
            'options' => ['class' => 'navbar-nav me-auto'],
            'encodeLabels' => false,
            'items' => $items,
        ],
    ) ?>
    <?= Html::button(
        '&#127769;',
        [
            'id' => 'theme-toggle',
            'class' => 'btn btn-link nav-link fs-5',
            'aria-label' => 'Switch to dark mode',
        ],
    ) ?>
    <?php NavBar::end() ?>
</header>
