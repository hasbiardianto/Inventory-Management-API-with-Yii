<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Item extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%items}}';
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
            [['name', 'asset_code', 'category_id'], 'required'],
            [['category_id', 'quantity', 'minimum_stock'], 'integer', 'min' => 0],
            [['description'], 'string'],
            [['name', 'asset_code', 'condition', 'location'], 'string', 'max' => 150],
            [['asset_code'], 'unique'],
            [['condition'], 'in', 'range' => ['good', 'needs_service', 'damaged']],
            [['quantity'], 'default', 'value' => 0],
            [['minimum_stock'], 'default', 'value' => 0],
            [['condition'], 'default', 'value' => 'good'],
            [['category_id'], 'exist', 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'asset_code' => 'Asset Code',
            'category_id' => 'Category',
            'quantity' => 'Quantity',
            'minimum_stock' => 'Minimum Stock',
            'condition' => 'Condition',
            'location' => 'Location',
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
            'asset_code',
            'category_id',
            'category' => function($model) {
                return $model->category ? $model->category->name : null;
            },
            'quantity',
            'minimum_stock',
            'condition',
            'location',
            'description',
            'created_at',
            'updated_at',
        ];
    }
    
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
    
    public function extraFields()
    {
        return ['category'];
    }
}
