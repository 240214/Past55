<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $image
 * @property string $company
 * @property string $job_title
 * @property string $email
 * @property string $website
 * @property string $mobile
 * @property string $home_phone
 * @property string $address
 * @property string $note
 * @property integer $created_at
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'image','company', 'job_title', 'email', 'mobile', 'note'], 'required'],
            [['website', 'home_phone', 'address'], 'safe'],

            [['mobile'], 'integer'],
            [['note'], 'string', 'max' => 500],
            [['address'], 'string', 'max' => 225],
            [['first_name'], 'string', 'max' => 20],
            [['image'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * @inheritdoc
     */

}
