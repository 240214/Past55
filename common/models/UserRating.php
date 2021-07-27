<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "UserRating".
 *
 * @property integer $id
 * @property string $agent_id
 * @property string $rating
 * @property string $market_knowledge
 * @property string $trustworthness
 * @property string $resnonsiveness
 * @property string $negotiation_skill
 * @property string $overall
 */
class UserRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rating', 'agent_id','overall'], 'safe'],
            [['market_knowledge','review_at','trustworthness','resnonsiveness','negotiation_skill'], 'integer'],
            [['rating'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getRating($user)
    {
        $model = UserRating::find()->where(['agent_id'=>$user])->one();
        return ($model['overall'])?$model['overall']:'0';

    }

}
