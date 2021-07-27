<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog comments".
 *
 * @property integer $id
 * @property integer $blog_id
 * @property integer $user_id
 * @property string $user_name
 * @property string $comment
 * @property string $user_image
 * @property string $author
 * @property integer $created_at
 * @property integer $like_comment
 *
 */

class BlogComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_comment';
    }

    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['comment', 'required'],
            ['blog_body', 'string', 'min' => 500],
            [['user_name','user_image','user_id','created_at'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment' => Yii::t('app', 'Leave a comment: '),

        ];
    }

    public static function countComment($id)
    {
        return static::find()->where(['blog_id'=>$id])->count();
    }
    //


}
