<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "MortgageRating".
 *
 * @property integer $id
 * @property string $bank_id
 * @property string $rating
 * @property string $category_1
 * @property string $category_2
 * @property string $category_3
 * @property string $category_4
 * @property string $category_5
 */
class MortgageRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mortgage_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rating', 'bank_id','overall'], 'safe'],
            [['category_1','category_2','category_3','category_4','overall'], 'integer'],
            [['rating'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getRating($id)
    {
        $model = MortgageRating::find()->where(['bank_id'=>$id])->one();
        return ($model['overall'])?$model['overall']:'0';
    }

}
