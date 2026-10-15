<?php
namespace app\controllers\api;

use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\Cors;

class CategoriesController extends ActiveController
{
    public $modelClass = 'app\models\Category';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        // Enable CORS
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
        ];
        
        // Content negotiation
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        
        return $behaviors;
    }
    
    public function actions()
    {
        $actions = parent::actions();
        
        // Customize actions if needed
        
        return $actions;
    }
}
