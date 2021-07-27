<?php

namespace common\models;

use Yii;
define('IMG_BANK_LOGO', \yii::getAlias('@frontend').'/web/images/site/bank/');

/**
 * This is the model class for table "Mortgage".
 *
 * @property integer $id
 * @property integer $bank_name
 * @property string $bank_logo
 * @property string $bank_email
 * @property string $bank_contact_number
 * @property string $bank_about
 * @property string $loan_purpose
 * @property string $loan_product
 * @property integer $interest_rate
 * @property integer $arp
 * @property integer $loan_amount
 * @property integer $down_payment
 * @property integer $total_fees
 * @property integer $rate_lock
 * @property string $note
 * @property string $disclaimer
 * @property integer $likes
 * @property integer $rating
 * @property string $website
 * @property integer $created_at

 *
 */
class Mortgage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mortgage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bank_name', 'bank_logo','bank_contact_number','bank_email','bank_about','loan_purpose','loan_product','interest_rate','arp', 'loan_amount','down_payment','total_fees','rate_lock','note','disclaimer','likes','rating','website','created_at'], 'required'],
            ['id','safe'],
            ['bank_logo', 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg','maxWidth'=>120,'minWidth'=>120,'maxHeight'=>108,'minHeight'=>108, 'maxFiles' => 1],

        ];
    }

    /**
     * @inheritdoc
     */
    public function uploadLogo()
    {
        $name = rand(137, 999) . time();
        $this->bank_logo->saveAs(IMG_BANK_LOGO . $name . '.' . $this->bank_logo->extension);
        return $name.'.'.$this->bank_logo->extension;
    }
}
