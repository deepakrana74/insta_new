<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "main_categories".
 *
 * @property int $id
 * @property string $main_category_name
 * @property string $main_category_keywords
 *
 * @property SubCategories[] $subCategories
 */
class MainCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_category_name', 'main_category_keywords'], 'required'],
            [['main_category_keywords'], 'string'],
            [['main_category_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_category_name' => 'Main Category Name',
            'main_category_keywords' => 'Main Category Keywords',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategories()
    {
        return $this->hasMany(SubCategories::className(), ['main_category_id' => 'id']);
    }

    public function getParentCategories(){

        $parent_categories = MainCategories::find()
                            ->select('*')
                            ->asArray()
                            ->all();
        
        return $parent_categories;
    }

    public function getParentCategoriesById($id){
        $parent_categories = MainCategories::find()
                            ->select(['main_category_name'])
                            ->where(['id'=>$id])
                            ->all();
        
        return $parent_categories;
    }
    
}
