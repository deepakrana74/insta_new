<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
/*
  * User Model
  * This Model is used for control the all users who entered on users table
 */  
class User extends ActiveRecord implements IdentityInterface {
    /**
	  * Model name field
	  * @var string
	*/  
	
	public static function tableName()
    {
        return 'users';
    }

	public function rules()
    {
        return [
            [['email', 'password', 'mobile'], 'required'],
            [['created_at'], 'safe'],
            [['user_type_id','status','mobile'], 'integer'],
            [['password'], 'string', 'max' => 255],
            [['profile_image'], 'string', 'max' => 100],
            [['email'], 'unique'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email Id',
            'activation_key' => 'Activation Key',
            'username' => 'Username',
            'name' => 'Name',
            'password' => 'Password',
			'mobile' => 'Mobile',
			'address' => 'Address',
			'profile_image' => 'Profile Image',
			'pincode' => 'Pincode',
			'address' => 'Address',
            'created_at' => 'Created At',
            'user_type_id' => 'Usertype ID',
			'country_detail_id' => 'Country Detail Id',
			'city_id' => 'City Id',
            'status' => 'Status',
        ];
    }
    
    /*
    public function getUsertype()
    {
        return $this->hasOne(Usertype::className(), ['id' => 'id']);
    }
    */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    public static function findByEmail($email)
    {
        return static::findBySql("SELECT * FROM users WHERE email LIKE BINARY '$email'")->one();
    }  
    
    public static function findByName($id)
    {
        return static::findBySql("SELECT * FROM users WHERE id LIKE BINARY '$id'")->one();
    } 
    
    public static function findByToken($token)
    {
        return static::findBySql("SELECT id FROM users WHERE activation_key LIKE BINARY '$token'")->one();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }
    public function getAuthKey()
    {
        return $this->activation_key;
    }
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    public function setPassword($password)
    {
        return $this->password = Yii::$app->security->generatePasswordHash($password);		//echo $this->password; die;
    }
    public function generateAuthKey()
    {
       $this->activation_key = Yii::$app->security->generateRandomString();
    }
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function ValidateEmail($email)
    {
        $CheckDetails = User::find()->where(['email'=>$email])->asArray()->count();
        return $CheckDetails;
    }
    public function ValidateCode($code)
    {
        $CheckDetails = User::find()->where(['activation_key'=>$code])->asArray()->count();
        return $CheckDetails;
    }
	
	public function Allfind()
    {
        $Result=User::find()
				->where(['not in','id',1])
                ->asArray()->all();
		return $Result;
    }

    public function GetUserDetails($id)
    {
        $queryDetails = new \yii\db\Query();
        $UserDetails = $queryDetails->select(['users.*','api_auth_key.auth_key'])
            ->from('users')
            ->join('inner join', 'api_auth_key',
                'users.id = api_auth_key.user_id')
            ->andwhere(['users.id'=>$id])
            ->one();
        return $UserDetails;

    }

    public function SendEmail($email,$subject,$mailbody,$senderemail)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://admin.alone.city/login/sendmymail");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"receiveremail=".$email."&fromemail=".$senderemail."&subject=".urlencode($subject)."&message=".urlencode($mailbody));
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        curl_close($ch);
        return $server_output;
    }




}