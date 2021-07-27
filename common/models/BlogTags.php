<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_tags".
 *
 * @property integer $id
 * @property string $tag
 * @property string $blog
 *

 *
 */
class BlogTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_tags';
    }



    /**
     * @inheritdoc
     */

    public static function addTag($tags)
    {
        $tagsExplod = explode(',',$tags);
        var_dump($tagsExplod);

        foreach ($tagsExplod as $tag)
        {
            $check = static::IsUnique($tag);
            if($check)
            {
                $tagModel = new BlogTags();
                $tagModel->tag = $tag;
                $tagModel->blog = 1;
                $tagModel->save(false);
            }

        }
    }
    public function IsUnique($tags)
    {
        $model = static::find()->where(['tag'=>$tags]);

        $found = ($model->count() == 0)?true:false;
        if($found)
        {
            return true;
        }
        else
        {
           $tag =  $model->one();
            $tag->blog = $tag->blog + 1;
            $tag->save(false);
            return false;
        }
    }

}
