<?php

namespace backend\models;

use yii\base\Model;
use common\models\User;
use common\models\Admin;

/**
 * Signup form
 */
class SignupForm extends Model{
	public $username;
	public $email;
	public $password;
	
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			['username', 'trim'],
			['username', 'safe'],
			['username', 'string', 'min' => 2, 'max' => 255],
			
			['email', 'trim'],
			['email', 'safe'],
			['email', 'email'],
			['email', 'string', 'max' => 255],
			
			['password', 'safe'],
			['password', 'string', 'min' => 6],
		];
	}
	
	/**
	 * Signs user up.
	 * @return User|null the saved model or null if saving fails
	 */
	public function signup(){
		if(!$this->validate()){
			return null;
		}
		
		$user           = new Admin();
		$user->username = $this->username;
		$user->email    = $this->email;
		$user->setPassword($this->password);
		$user->generateAuthKey();
		
		return $user->save() ? $user : null;
	}
	
	public function change(){
		if($this->validate()){
			
			$id             = \Yii::$app->user->identity->getId();
			$user           = Admin::find()->where(['id' => $id])->one();
			$user->username = $this->username;
			$user->email    = $this->email;
			
			if(!empty($this->password)){
				$user->setPassword($this->password);
				$user->generateAuthKey();
			}
			
			if($user->save()){
				return $user;
			}
		}
		
		return null;
		
		
	}
	/**
	 * @inheritdoc
	 */
}
