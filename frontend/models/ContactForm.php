<?php

namespace frontend\models;

use common\models\Leads;
use himiklab\yii2\recaptcha\ReCaptchaValidator3;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model{
	public $name;
	public $email;
	public $phone;
	public $subject;
	public $reciever;
	public $title;
	public $image;
	public $message;
	public $verifyCode;
	public $reCaptcha;
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['name', 'email', 'phone', 'message', 'reCaptcha'], 'required'],
			[['reciever', 'title', 'subject', 'image'], 'safe'],
			
			// email has to be a valid email address
			['email', 'email'],
			// verifyCode needs to be entered correctly
			// ['verifyCode', 'captcha'],
			[['reCaptcha'], ReCaptchaValidator3::className(),
				'threshold' => 0.5,
				#'secret' => 'your secret key', // unnecessary if reСaptcha is already configured
				'action' => 'contact',
			],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels(){
		return [
			'verifyCode' => 'Verification Code',
		];
	}
	
	private function setMailerTransportParams(){
		Yii::$app->mailer->setTransport([
			'class' => 'Swift_SmtpTransport',
			'host' => Yii::$app->params['settings']['smtp_params']['host'],
			'username' => Yii::$app->params['settings']['smtp_params']['username'],
			'password' => Yii::$app->params['settings']['smtp_params']['password'],
			'port' => Yii::$app->params['settings']['smtp_params']['port'],
			'encryption' =>  Yii::$app->params['settings']['smtp_params']['encryption'],
		]);
	}
	
	/**
	 * Sends an email to the specified email address using the information collected by this model.
	 *
	 * @param string $email the target email address
	 *
	 * @return bool whether the email was sent
	 */
	public function sendEmail($email = ''){
		if(!$email){
			$email = Yii::$app->params['settings']['email'];
		}
		
		$mail_body = $this->createMailBody();
		
		$this->setMailerTransportParams();
		
		return Yii::$app->mailer
			->compose()
			->setTo($email)
			->setFrom([$this->email => $this->name])
			->setSubject($this->subject)
			->setHtmlBody($mail_body)
			->send();
	}
	
	public function inquiry($email = ''){
		if(!$email){
			$email = Yii::$app->params['settings']['email'];
		}
		
		$leads             = new Leads();
		$leads->sender     = $this->name;
		$leads->phone      = $this->phone;
		$leads->email      = $this->email;
		$leads->message    = $this->message;
		$leads->save(false);
		
		$mail_body = $this->createMailBody();
		
		$this->setMailerTransportParams();
		
		return Yii::$app->mailer
			->compose()
			->setTo($email)
			->setFrom([$this->email => $this->name])
			->setSubject($this->subject)
			->setHtmlBody($mail_body)
			->send();
		
	}
	
	private function createMailBody(){
		$html = [];
		
		$html[] = sprintf('<p>Name: %s</p>', $this->name);
		$html[] = sprintf('<p>Email: %s</p>', $this->email);
		$html[] = sprintf('<p>Phone: %s</p>', $this->phone);
		$html[] = sprintf('<p>Message: %s</p>', $this->message);
		
		return implode(PHP_EOL, $html);
	}
	
}
