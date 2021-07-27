<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent
 * @property string $subcategory_type
 * @property string $input_options
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'parent', 'subcategory_type'], 'required'],
            [['parent'], 'integer'],
            [['input_options'], 'safe'],

            [['subcategory_type'], 'string'],
            [['name'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'parent' => Yii::t('app', 'Parent'),
            'subcategory_type' => Yii::t('app', 'Subcategory Type'),
            'input_options' => Yii::t('app', 'Input Options'),
        ];
    }
}
