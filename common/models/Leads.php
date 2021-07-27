<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $sender
 * @property integer $reciever
 * @property string $image
 * @property string $title
 * @property integer $mobile
 * @property string $email
 * @property string $message
 * @property string $status
 * @property integer $created_at
 *
 */
class Leads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender', 'reciever', 'mobile','email','message'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */

}
