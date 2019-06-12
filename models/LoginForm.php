<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email id or password.');
            }
        }
    }
	
	 public function login()
    {
        if ($this->validate()) 
		{
			if($this->getStatus()== 1)
            {
            return Yii::$app->user->login($this->getUser());
			}
		}
        return false;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

    public function getStatus(){
        $status = $this->getUser();
        $status = $status['status'];
        return $status;
    }
    public function getVerify(){
        $status = $this->getUser();
        $status = $status['verify'];
        return $status;
    }
	
	public function getUserType(){
        $type = $this->getUser();
        $type = $type['user_type_id'];
        return $type;
    }

    public function GetUserDetails($email,$lastid)
    {
        $queryDetails = new \yii\db\Query();
        $UserDetails = $queryDetails->select(['users.*','api_auth_key.auth_key'])
            ->from('users')
            ->join('inner join', 'api_auth_key',
                'users.id = api_auth_key.user_id')
            ->andwhere(['users.email'=>$email,'api_auth_key.id'=>$lastid])
            ->one();
        return $UserDetails;

    }
}
