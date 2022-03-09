<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\image\drivers\Image;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

/**
 * User model
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_write
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $active
 * @property string $image
 * @property string $name
 * @property string $mobile
 * @property string $about
 * @property string $city
 * @property string $country
 * @property string $address
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password
 */
class Users extends ActiveRecord implements IdentityInterface{

	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 1;

	public $new_password;
	public $preview;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName(){
		return '{{%users}}';
	}
	
	/**
	 * @inheritdoc
	 */
	public function behaviors(){
		return [
			TimestampBehavior::className(),
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			['active', 'default', 'value' => self::STATUS_ACTIVE],
			['active', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
			[['username', 'new_password', 'email', 'name', 'mobile', 'about', 'city', 'country'], 'safe'],
			[['mobile'], 'integer'],
			
			[['username', 'email', 'name', 'about', 'city', 'country'], 'string'],
			[['about'], 'string', 'max' => 225],
			[['address'], 'string', 'max' => 225],
			[['name'], 'string', 'max' => 20],
			[['image'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
		
		];
	}
	
	public function attributeLabels(){
		return [
			'name'           => Yii::t('app', 'Full Name'),
			'email'           => Yii::t('app', 'Email'),
			'mobile'           => Yii::t('app', 'Mobile'),
			'image'          => Yii::t('app', 'Avatar'),
			'username'       => Yii::t('app', 'Username'),
			'password_write' => Yii::t('app', 'New Password'),
		
		
		];
	}
	
	public function photo(){
		//        $name = rand(137, 999) . time();
		//        $this->image->saveAs(USER_IMG . $name . '.' . $this->image->extension);
		//        return $name;
		foreach($this->image as $file){
			$name     = rand(137, 999).time();
			$screen[] = $name.'.'.$file->extension;
			$file->saveAs(USER_IMG.$name.'.'.$file->extension);
		}
		
		return $ScreenChunk = implode(",", $screen);
		
	}
	
	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id){
		return static::findOne(['id' => $id, 'active' => self::STATUS_ACTIVE]);
	}
	
	/**
	 * @inheritdoc
	 */
	public static function getAbout($id){
		$user = static::findOne(['id' => $id]);
		
		return $user->about;
	}
	
	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null){
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}
	
	/**
	 * Finds user by username
	 *
	 * @param string $username
	 *
	 * @return static|null
	 */
	public static function findByUsername($username){
		return static::findOne(['username' => $username, 'active' => self::STATUS_ACTIVE]);
	}
	
	/**
	 * Finds user by password reset token
	 *
	 * @param string $token password reset token
	 *
	 * @return static|null
	 */
	public static function findByPasswordResetToken($token){
		if(!static::isPasswordResetTokenValid($token)){
			return null;
		}
		
		return static::findOne([
			'password_reset_token' => $token,
			'active'               => self::STATUS_ACTIVE,
		]);
	}
	
	public static function agentDetail($type, $id){
		$agent = Users::findOne($id);
		
		return $agent->$type;
	}
	
	/**
	 * Finds out if password reset token is valid
	 *
	 * @param string $token password reset token
	 *
	 * @return bool
	 */
	public static function isPasswordResetTokenValid($token){
		if(empty($token)){
			return false;
		}
		
		$timestamp = (int)substr($token, strrpos($token, '_') + 1);
		$expire    = Yii::$app->params['user.passwordResetTokenExpire'];
		
		return $timestamp + $expire >= time();
	}
	
	/**
	 * @inheritdoc
	 */
	public function getId(){
		return $this->getPrimaryKey();
	}
	
	/**
	 * @inheritdoc
	 */
	public function getAuthKey(){
		return $this->auth_key;
	}
	
	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey){
		return $this->getAuthKey() === $authKey;
	}
	
	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 *
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password){
		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}
	
	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function setPassword($password){
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}
	
	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey(){
		$this->auth_key = Yii::$app->security->generateRandomString();
	}
	
	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken(){
		$this->password_reset_token = Yii::$app->security->generateRandomString().'_'.time();
	}
	
	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken(){
		$this->password_reset_token = null;
	}
	
	public function beforeSave($insert){
		
		if(!$insert){
			$id = intval(Yii::$app->request->get('id'));
			$this->saveImages($id, $insert);
		}
		
		return parent::beforeSave($insert);
	}
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
		
		if($insert){
			$this->saveImages($this->id, $insert);
		}
	}
	
	private function saveImages($id = 0, $insert){
		if($id == 0) return;
		
		$dir = Yii::getAlias('@users_images').'/'.$id;
		
		if(!is_dir($dir)){
			FileHelper::createDirectory($dir, 0777);
			FileHelper::createDirectory($dir.'/thumbs', 0777);
		}
		
		if($file = UploadedFile::getInstance($this, 'preview')){
			#VarDumper::dump($file, 10, 1); exit;
			if(file_exists($dir.'/'.$this->image) && is_file($dir.'/'.$this->image)){
				FileHelper::unlink($dir.'/'.$this->image);
			}
			if(file_exists($dir.'/thumbs/'.$this->image) && is_file($dir.'/thumbs/'.$this->image)){
				FileHelper::unlink($dir.'/thumbs/'.$this->image);
			}
			
			$this->image = $id.'_'.time().'_'.rand(137, 999).'.'.$file->extension;
			
			$file->saveAs($dir.'/'.$this->image);
			
			foreach(Yii::$app->params['avatar_sizes'] as $name => $size){
				$image = Yii::$app->image->load($dir.'/'.$this->image);
				$image->background('#ffffff', 0);
				$image->resize($size, $size, Image::CROP);
				$image->save($dir.'/thumbs/'.str_replace('.'.$file->extension, '_'.$size.'.'.$file->extension, $this->image), 90);
			}
		}
		
		if($insert){
			$this->save();
		}
	}
	
	public function getAvatar($size = '250'){
		$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/common/noimage.svg';
		
		if($this->image){
			$pathinfo = pathinfo($this->image);
			if($size == 'full' || $size == ''){
				$file_name = $pathinfo['filename'].'.'.$pathinfo['extension'];
				$file = $this->id.'/'.$file_name;
			}else{
				$file_name = $pathinfo['filename'].'_'.$size.'.'.$pathinfo['extension'];
				$file = $this->id.'/thumbs/'.$file_name;
			}
			
			if(file_exists(Yii::getAlias('@users_images').'/'.$file)){
				$image = Yii::$app->urlManagerFrontend->baseUrl.'/images/users/'.$file;
			}
		}
		
		return $image;
	}
	
}
