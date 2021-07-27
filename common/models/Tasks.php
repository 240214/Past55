<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $task
 * @property string $category
 * @property string $priority
 * @property string $complete
 * @property string $created_at
 *
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task', 'category', 'priority','email','message'], 'required'],
            ['complete','safe']
        ];
    }

    /**
     * @inheritdoc
     */

}
