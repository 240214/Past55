<?php
namespace frontend\models;

use common\models\TaskLabels;
use yii\base\Model;
use common\models\Users;

/**
 * TaskLabel form
 */
class TaskLabelForm extends Model
{
    public $label;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['label', 'trim'],
            ['label', 'required'],
            ['label', 'unique', 'targetClass' => '\common\models\TaskLabels', 'message' => 'This Labels has already been taken.'],
            ['label', 'string', 'min' => 2, 'max' => 255],


        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function add()
    {
        if (!$this->validate()) {
            return null;
        }

        $label = new TaskLabels();
        $label->label = $this->label;

        return $label->save() ? $label : null;
    }
}
