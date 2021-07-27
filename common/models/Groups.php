<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $group_name
 * @property string $admin
 * @property integer $created_at
 *
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_name', 'user_id'], 'required'],
            ['admin','safe']
        ];
    }

    /**
     * @inheritdoc
     */

}
