<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group_members".
 *
 * @property integer $id
 * @property integer $group_id
 * @property integer $contact_id
 * @property string $contact_name
 * @property string $contact_image
 * @property integer $user_id
 * @property integer $created_at
 *
 */
class GroupMembers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_members';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact_name', 'contact_id'], 'required'],
            ['contact_image','safe']
        ];
    }

    /**
     * @inheritdoc
     */

    public static function isMember($id,$gid)
    {
        $model = GroupMembers::find()->where(['group_id'=>$gid])->andWhere(['contact_id'=>$id])->count();
        if($model)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
}
