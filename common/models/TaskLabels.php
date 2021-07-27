<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $label
 *
 */
class TaskLabels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_labels';
    }

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            ['label', 'trim'],
            ['label', 'required'],
            ['label', 'unique', 'targetClass' => '\common\models\TaskLabels', 'message' => 'This Labels has already in the list.'],
            ['label', 'string', 'min' => 2, 'max' => 50],

        ];
    }
    /**
     * @inheritdoc
     */

}
