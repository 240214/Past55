<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "UserReview".
 *
 * @property integer $id
 * @property string $agent_id
 * @property string $user_id
 * @property string $name
 * @property string $description
 * @property string $market_knowledge
 * @property string $trustworthness
 * @property string $resnonsiveness
 * @property string $negotiation_skill
 * @property string $overall
 * @property string $review_at
 */
class UserReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'agent_id','description'], 'safe'],
            [['market_knowledge','review_at','trustworthness','resnonsiveness','negotiation_skill','overall'], 'string'],
            [['description'], 'required'],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */


}
