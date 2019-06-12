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
                    ->select(['hash_tags', 'sub_category_name'])
                    ->from('sub_categories')
                    ->where(['sub_category_name'=>$keyword])
                    ->asArray()
                    ->one();

        return $hashTags;     
    }

    //********************************************************************************************//
    
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
                    ->select('*')
                    ->where(['main_category_id'=>$main_category_id])
                    ->asArray()
                    ->all();

        return $sub_categories;
    }


    public function hashTagSearch($keywords,$limit) {
     $category = array();   
     $categories = array();  
     for($i=0;$i<count($keywords);$i++) 
     {
       // color codes for different keywords
       if($i == 0){ $clr ='#000000'; } elseif($i == 1){ $clr = '#0000FF'; } elseif($i == 2) { $clr = '#FF0000'; }
        
       $SearchResult = $this->getindividualexacthashtags($keywords[$i]);
 
       if($SearchResult) 
       { 
        // Get all hashtags from subcategories 
        $static = explode(",",$SearchResult['hash_tags']);
        $prefix = "_".$clr.',';
        $colored = implode("_" . $prefix,$static).$prefix;
        $subCategoryTags = array_filter(explode(",",$colored));
        
        // Static first 3 hashtags 
        $staticHashtags = array_slice($subCategoryTags,0,3);

        // Remove first 3 hashtags from array to avoid redundancy
        $redundent = array_slice($subCategoryTags,4,(count($subCategoryTags)-1));

        // Get random 27 Tags from sub
        if(count($redundent)>28){
          $randomindexes = array_rand($redundent,28);
        } else {
          $randomindexes = array_rand($redundent,count($redundent));  
        }
        

        $RandomHashTags = array();
        for($k=0;$k<count($randomindexes);$k++) {
         $RandomHashTags[] = $redundent[$randomindexes[$k]];
        }
       
        // Combine all 30 hashtags (3 static hashtags + 27 random)
        $combinedHashtags = array_merge($staticHashtags,$RandomHashTags);

        //removing color codes from hashtags
        $hasgstring = implode(',',$combinedHashtags);
        $withoutcolors = array_slice(explode('__'.$clr.',',$hasgstring),0,30);
        
        $category[] = array(
                    'name'=> $keywords[$i],
                    'hashtag' =>$withoutcolors 
                    );

        $categories[] = $combinedHashtags;
           
       } else {
        // Search hashtags in hashtag list if not found in subcategories, if not found in category list
        
        // Get list of all subcategories
        $allsubcats = $this->getallsubcategories();
        if($allsubcats) {
          foreach($allsubcats as $subcat) {

            $allsubhashtags = explode(',',$subcat['hash_tags']);
            
            if(in_array('#'.$keywords[$i], $allsubhashtags)) {

              $prefix = "_".$clr.',';
              $colored = implode("_" . $prefix,$allsubhashtags).$prefix;
              $subCategoryTags = array_filter(explode(",",$colored));

              // Searched hashtag
              $searchedkeyword = '#'.$keywords[$i]; 
              
              // Static first 3 hashtags 
              $staticHashtags = array_merge(array($searchedkeyword.'__'.$clr),array_slice($subCategoryTags,0,3));

              // Remove first 3 hashtags from array to avoid redundancy
              $redundent = array_slice($subCategoryTags,4,(count($subCategoryTags)-1));
           
              // Get random 26 Tags from sub
              $randomindexes = array_rand($redundent,28);

              $RandomHashTags = array();
              for($k=0;$k<count($randomindexes);$k++) {
               $RandomHashTags[] = $redundent[$randomindexes[$k]];
              }
           
              // Combine all 30 hashtags (3 static hashtags + 27 random)
              $combinedHashtags = array_merge($staticHashtags,$RandomHashTags);
             
              //removing color codes from hashtags
              $hasgstring = implode(',',$combinedHashtags);
              $withoutcolors = array_slice(explode('__'.$clr.',',$hasgstring),0,30);
                
              $category[] = array(
                            'name'=> $keywords[$i],
                            'hashtag' =>$withoutcolors 
                           );

              // combine all hashtags with searched hastags
              $combinewithsearched = array_unique(array_merge(array($searchedkeyword.'__'.$clr),$combinedHashtags)); 
              $categories[] = $combinewithsearched;

            }
          }
        } else {   
         // hashtag not found in subcategory or not in hashtags list  
         return false;   
        }
      }

     }

     $keywordCount = count($keywords);
     $hashtagpercentage = round(100/$keywordCount);

     // keywords to be taken from each category
     $keywordpicking = round($limit*$hashtagpercentage/100);

     $relevent = array();
     if($categories){
      for($j=0;$j<count($categories);$j++) {
        $relevent[] = array_slice($categories[$j],0,($keywordpicking+1));
      }
     } else {
        return false;
     }

     $test = array_unique(array_slice(call_user_func_array('array_merge', $relevent),0,$limit));
     $releventcombined = array_values($test);
     
     $relevent_tags = array();
     $relevent_colors = array();

     for($d=0;$d<count($releventcombined);$d++){  
      $explode_element = explode('__',$releventcombined[$d]);
       $elementsCount = count($explode_element);
       if($elementsCount ==2){
        $relevent_tags[] = $explode_element[0];
        $relevent_colors[] = $explode_element[1];
       } else {
        $explo = explode('_',$explode_element[0]);
        $relevent_tags[] = $explo[0];
        $relevent_colors[] = $explo[1];
       }  
     }

     $redundantrelevent = array_unique($relevent_tags);
     $newcat = array();
     $check = array();
     foreach($category as $key=>$value){
      if($key<1){
        $newcat[] = array('name'=>$keywords[$key],'hashtag'=>$value['hashtag']);
      } else {
        foreach($newcat as $new){
          $searchkey = '#'.$keywords[$key];
          if(!in_array($searchkey, $new['hashtag'])) {
          $check[] = array('name'=>$keywords[$key],'hashtag'=>$value['hashtag']);
         } 
        }
      }
     } 
     $newcheck = array_merge($newcat,$check);
     //print_r($newcheck);

     $new = array();
     foreach ($newcheck as $key => $value) {
       if($key == 0){
        $new[] = array("name" =>$newcheck[0]['name'], "hashtag"=>$newcheck[$key]['hashtag']);
       } elseif($key == 1){
        $new[] = array("name" =>$newcheck[1]['name'], "hashtag"=>array_values(array_diff($newcheck[1]['hashtag'],$newcheck[0]['hashtag'])));
       } elseif($key == 2){
        $cobinefirstsec = array_merge($newcheck[0]['hashtag'],$newcheck[1]['hashtag']);
        $new[] = array("name" =>$newcheck[2]['name'], "hashtag"=>array_values(array_diff($newcheck[2]['hashtag'],$cobinefirstsec)));
       }
     }

     $data = array(
             'categories' => $new,
             'relevent_tags' => array_values($redundantrelevent),
             'relevent_colors' => $relevent_colors 
            );
     return $data;            
    }


    public function getindividualexacthashtags($searchkey) {
       
     $queryDetails = new \yii\db\Query();
     $hashTags = $queryDetails->select('*')
        ->from('sub_categories')
        ->join('inner join', 'main_categories', 'sub_categories.main_category_id = main_categories.id')    
        ->where(['sub_categories.sub_category_name'=> $searchkey])
        ->one();

     return $hashTags;     
    }

   

    public function getallsubcategories() {
       
     $queryDetails = new \yii\db\Query();
     $hashTags = $queryDetails->select('*')
        ->from('sub_categories')
        ->orderBy(['id'=>SORT_DESC])
        ->all();

     return $hashTags;     
    }

    public function subcategories() {
       
      $queryDetails = new \yii\db\Query();
      $hashTags = $queryDetails->select('*')
         ->from('sub_categories')
         ->all();
 
      return $hashTags;     
     }


}
