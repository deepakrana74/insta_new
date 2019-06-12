<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usertype".
 *
 * @property integer $usertype_id
 * @property string $usertype_name
 *
 * @property User[] $users
 */
class Usertype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_detail'], 'required'],
            [['type_detail'], 'string', 'max' => 45],
            [['type_detail'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Usertype ID',
            'type_detail' => 'Type Detail',
        ];
    }
    
}