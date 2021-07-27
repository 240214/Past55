<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_write
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property string $image
 * @property string $name
 * @property string $mobile
 * @property string $about
 * @property string $city
 * @property string $country
 * @property string $address
 * @property string $favourites
 * @property string $role
 * @property string $deal_property_type
 * @property string $agent_type
 * @property string $dealing_in
 * @property string $languages
 * @property string $price_min
 * @property string $price_max
 * @property string $profile_status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password
 *
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $password_write;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'password_write', 'email','favourites', 'name', 'mobile', 'about', 'role','deal_property_type', 'dealing_in', 'city', 'country'], 'safe'],
            [['mobile'], 'integer'],
            [['price_max','price_min'], 'string'],

            [['username', 'email', 'name', 'about', 'role', 'city', 'country'], 'string'],
            [['about'], 'string', 'max' => 225],
            [['address'], 'string', 'max' => 225],
            [['name'], 'string', 'max' => 20],
            [['image'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

        ];
    }
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Your Name'),
            'image' => Yii::t('app', 'Profile Photo'),
            'username' => Yii::t('app', 'Choose Unique Username'),
            'password_write' => Yii::t('app', 'Choose Password'),



        ];
    }
    public function photo()
    {
//        $name = rand(137, 999) . time();
//        $this->image->saveAs(USER_IMG . $name . '.' . $this->image->extension);
//        return $name;
        foreach ($this->image as $file)
        {
            $name = rand(137, 999) . time();
            $screen[] = $name . '.'.$file->extension;
            $file->saveAs(USER_IMG . $name. '.' . $file->extension);
        }
        return $ScreenChunk = implode(",", $screen);

    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * @inheritdoc
     */
    public static function getAbout($id)
    {
        $user = static::findOne(['id' => $id]);
        return $user->about;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function agentDetail($type,$id)
    {
        $agent = User::findOne($id);
        return $agent->$type;
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
