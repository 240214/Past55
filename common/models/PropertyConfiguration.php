<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "property_configuration".
 *
 * @property integer $id
 * @property integer $property_id
 * @property string $name
 * @property string $value
 */
class PropertyConfiguration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'property_configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_id', 'name', 'value'], 'required'],
            [['property_id'], 'integer'],
            [['value'], 'number', 'max' => 100000000],
            [['name', ], 'string', 'max' => 120],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'property_id' => Yii::t('app', 'Property ID'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public static function addNewConfiguration($name,$value,$id)
    {
        $model = new PropertyConfiguration();
        $model->name = $name;
        $model->property_id = $id;
        if(is_array($value))
        {
            $set = implode(",",$value);
            $model->value = $set;

        }
        else
        {
            $model->value = $value;

        }
        $model->save(false);
        return true;

    }
    public static function get($id)
    {
        $model = static::find()->where(['property_id'=>$id])->all();
        echo "<table class='col-lg-12'>";
        foreach($model as $list)
        {
            echo "<tr><td class='col-lg-4'> <small><b>".$list['name']." </b></small></td> <td class='col-lg-4'> : </td> <td  class='col-lg-4'><small>". $list['value']."</small></td></tr>";
        }
        echo "</table>";
    }
}
