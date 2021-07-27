<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Notes".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $note_title
 * @property integer $note_tag
 * @property string $note_description
 * @property string $created_at
 * @property string $update_at
 */
class Notes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['note_title','note_tag', 'note_description'], 'required'],
            ['update_at','safe'],
            [['note_description'], 'string','max' => 500],
            [['note'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'note_title' => Yii::t('app', 'Note Title'),
            'note_description' => Yii::t('app', 'Note Description'),

        ];
    }
}
