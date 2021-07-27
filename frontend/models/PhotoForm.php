<?php
namespace frontend\models;

use yii\base\Model;
use common\models\ad;
use yii\web\UploadedFile;
/**
 * PhotoForm form
 */
define("IMG_COVER",\Yii::getAlias('@webroot')."/images/property/cover/");
define("IMG_FLOORPLAN",\Yii::getAlias('@webroot')."/images/property/floorplan/");
define("IMG_SCREENSHOT",\Yii::getAlias('@webroot')."/images/property/screen/");

class PhotoForm extends Model
{
    public $cover;
    public $screenshot;
    public $floorplan;

    /**
     * @var UploadedFile[]
     */

    public function rules()
    {
        return [
            [['screenshot'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
            [['cover'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['floorplan'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function cover()
    {
        $time = time();
        $this->cover->saveAs(IMG_COVER . $this->cover->baseName."_".$time  . '.' . $this->cover->extension);
        return $name = $this->cover->baseName."_".$time. '.' . $this->cover->extension;

    }

    public function floorplan()
    {
        $time = time();
        $this->floorplan->saveAs(IMG_FLOORPLAN . $this->floorplan->baseName."_".$time . '.' . $this->floorplan->extension);
       return $name = $this->floorplan->baseName."_".$time. '.' . $this->floorplan->extension;

    }



    public function screenshot()
    {
        $time = time();

        foreach ($this->screenshot as $file)
        {
            $file->saveAs(IMG_SCREENSHOT . $file->baseName."_".$time  . '.' . $file->extension);
            $name[] = $file->baseName."_".$time. '.' . $file->extension;
        }
        return implode(",",$name);
    }


}
