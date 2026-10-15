<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%categories}}';
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
            'item_count' => function($model) {
                return $model->getItems()->count();
            },
        ];
    }
    
    public function getItems()
    {
        return $this->hasMany(Item::class, ['category_id' => 'id']);
    }
    
    public function extraFields()
    {
        return ['items'];
    }
}
