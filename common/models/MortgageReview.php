<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mortgage_review".
 *
 * @property integer $id
 * @property string $bank_id
 * @property string $user_id
 * @property string $name
 * @property string $description
 * @property string $category_1
 * @property string $category_2
 * @property string $category_3
 * @property string $category_4
 * @property string $overall
 * @property string $review_at
 */
class MortgageReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mortgage_review';
    }

    /**bank_rating
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'bank_id','description'], 'safe'],
            [['overall','category_4','category_3','category_2','category_1'], 'string'],
            [['description'], 'required'],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */


}
