<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $blog_id
 * @property integer $user_id
 * @property integer $author_name
 * @property integer $author_image
 * @property integer $blog_author
 * @property integer $bloge_id
 * @property integer $blog_image
 * @property integer $blog_title
 * @property integer $blog_body
 * @property integer $blog_tags
 * @property integer $blog_comments
 * @property integer $created_at
 *
 */
define('IMG_BLOG', \yii::getAlias('@frontend').'/web/images/blog/');

class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
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
            [['blog_image', 'blog_title', 'blog_body','blog_tags'], 'required'],
            ['blog_body', 'string', 'min' => 500],
            [['author_name','author_image','created_at'],'safe'],
            ['blog_image', 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg','maxWidth'=>960,'minWidth'=>960,'maxHeight'=>520,'minHeight'=>520, 'maxFiles' => 1],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'blog_image' => Yii::t('app', 'Blog Image: '),
            'blog_title' => Yii::t('app', 'Title:'),
            'blog_body' => Yii::t('app', 'Blog Description'),
            'blog_tags' => Yii::t('app', 'Tags'),
        ];
    }
    public function uploadLogo()
    {
        $name = rand(137, 999) . time();
        $this->blog_image->saveAs(IMG_BLOG . $name . '.' . $this->blog_image->extension);
        return $name.'.'.$this->blog_image->extension;
    }


}
