<?php

namespace frontend\models;

use common\models\Leads;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $mobile;
    public $subject;
    public $reciever;
    public $title;
    public $image;
    public $body;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject','mobile', 'body'], 'required'],
            [['reciever', 'title', 'image'], 'safe'],

            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
           // ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }


    public function inquiry($email)
    {
        $leads = new Leads();
        $leads->sender = $this->name;
        $leads->reciever = $this->reciever;
        $leads->mobile = $this->mobile;
        $leads->title = $this->title;
        $leads->image = $this->image;
        $leads->email = $this->email;


        $leads->message = $this->body;
        $leads->created_at = time();
        $leads->save(false);

        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }

    public function BanKInquiry($email)
    {


        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }




}
