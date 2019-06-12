<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_categories".
 *
 * @property int $id
 * @property string $sub_category_name
 * @property string $sub_category_group
 * @property int $main_category_id
 *
 * @property MainCategories $mainCategory
 */
class SubCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_category_name', 'hash_tags'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub_category_name' => 'Sub Category Name',
            'sub_category_group' => 'Sub Category Group',
            'main_category_id' => 'Main Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainCategory()
    {
        return $this->hasOne(MainCategories::className(), ['id' => 'main_category_id']);
    }

    /**
     * {@inheritdoc}
     * @return SubCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubCategoriesQuery(get_called_class());
    }

    //hashtag finding query is written here
    public function hashTags($keyword){

        $hashTags = SubCategories::find()
                    ->select(['hash_tags', 'sub_category_name','id'])
                    ->from('sub_categories')
                    ->where(['sub_category_name'=>$keyword])
                    ->asArray()
                    ->one();

        return $hashTags;     
    }

    //********************************************************************************************//

     //hashtag finding query is written here
     public function hashTagsById($keyword_id){

        $hashTags = SubCategories::find()
                    ->select(['hash_tags', 'sub_category_name'])
                    ->from('sub_categories')
                    ->where(['id'=>$keyword_id])
                    ->asArray()
                    ->one();

        return $hashTags;     
    }
    
    //hashtagn finding using like conditon query 
    public function likeHashTags($keyword){
        $hash_tags = SubCategories::find()
                    ->select(['hash_tags','sub_category_name'])
                    ->from('sub_categories')
                    ->where(['like','sub_category_name', $keyword])
                    ->asArray()
                    ->one(); 

        return $hash_tags;
    }

    //query to find the keyword group
    public function getKeywordGroup($keyword){
        $hash_tags = SubCategories::find()
                    ->select(['sub_category_group'])
                    ->where(['sub_category_name'=> $keyword])
                    ->one(); 

        return $hash_tags;
    }

    
    //hashtag finding query is written here
    public function getGroupHashtags($group, $keyword){

        $hashTags = SubCategories::find()
                    ->select(['hash_tags'])
                    ->where(['sub_category_group'=>$group])
                    ->andWhere(['!=', 'sub_category_name', $keyword])
                    ->asArray()
                    ->all();

        return $hashTags;     
    }

    // all category and hashtag find query
    public function getSubCategories($main_category_id){
        $sub_categories = SubCategories::find()
                    ->select(['sub_category_name'])
                    ->where(['main_category_id'=>$main_category_id])
                    ->asArray()
                    ->all();

        return $sub_categories;
    }

    public function searchKeyword($keyword,$limit){
      $keys = explode(' ',$keyword);
       $hashTags = array();
        for($i=0;$i<count($keys);$i++){
            $hashTags[$keys[$i]] = SubCategories::find()
            ->select(['hash_tags'])
            ->where(['like','sub_category_name', $keys[$i]])
            ->asArray()
            ->all();   
        }
       return $hashTags;
    }

    //get all sub categories query
    public function getAllSubcategories(){
        $sub_categories = SubCategories::find()
                        ->select('*')
                        ->orderBy(['id'=>SORT_DESC])
                        ->asArray()
                        ->all();

        return $sub_categories;
                        
    }

}
