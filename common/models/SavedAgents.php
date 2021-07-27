<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $agent_id
 * @property string $user_id
 */
class SavedAgents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'saved_agents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'agent_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function add($agent)
    {
        $uid = Yii::$app->user->identity->getId();
        $find = SavedAgents::find()->where(['user_id'=>$uid])->andWhere(['agent_id'=>base64_decode($agent)])->one();

        if($find)
        {
            return "liked";
        }
        else
        {
            $model = new SavedAgents();
            $model->agent_id = base64_decode($agent);
            $model->user_id = $uid;
            if($model->save(false))
            {
                return true;
            }
            else
            {
                return false;
            }
        }


    }

    public static function remove($agent)
    {
        $uid = Yii::$app->user->identity->getId();
        $model = SavedAgents::find()->where(['user_id'=>$uid])->andWhere(['agent_id'=>base64_decode($agent)])->one();
        if($model->delete())
        {
            return true;
        }
        else
        {
            return false;
        }

    }
}
