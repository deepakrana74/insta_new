<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insta_users".
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property string $email
 */
class InstaUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'insta_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'password', 'email'], 'required'],
            [['name', 'email'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 30],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'password' => 'Password',
            'email' => 'Email',
        ];
    }

    public function findAdmin($email, $password){

        $admin = InstaUsers::find()
                ->where(['email'=>$email, 'password'=>$password])
                ->one();
        
        return $admin;
    }
}
