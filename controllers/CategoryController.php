<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\SubCategories;
use app\models\MainCategories;


class CategoryController extends Controller{

    public $enableCsrfValidation = false; //disable csrf 

    
    // public function actionIndex(){

    //     $main_category_model = new MainCategories();
    //     $sub_category_model = new SubCategories();

        
    //     $main_categories = $main_category_model->getParentCategories();

    //     foreach($main_categories as $main_category){ 

            
    //         $sub_categories = $sub_category_model->getSubCategories($main_category['id']);
            
    //         foreach($sub_categories as $sub_category_name){ 

    //             $sub_categories_name[] = $sub_category_name['sub_category_name'];
    //         }

    //         $final_limited_hash_tags = array_slice($sub_categories_name,0,39);
            
            
    //         $asd['categories'][] = array(
    //             'name' => $main_category['main_category_name'],
    //             'hashtag' => $final_limited_hash_tags 
    //         );
    //     }
        

    //     $response = array( 
    //         'status'=>true,
    //         'data'=> $asd
    //     );

        
    //     Yii::$app->response->format = Response::FORMAT_JSON;
    //     return $response;

    // }

    public function actionIndex(){
      $sub_category_model = new SubCategories();
      $subcats = $sub_category_model->subcategories();
      $categories = array();
      if($subcats){
        foreach($subcats as $subcat) {
         // $categories['categories'][] = array(
         //   'name' => $subcat['sub_category_name'],
         //   'hashtag' => explode(',',$subcat['hash_tags'])  
         // ); 
          $categories[] = $subcat['sub_category_name'];
        }   
      } else {
        $response = array(
            'status' => false,
            'message' => 'No categories found'    
            ); 
      }
      sort($categories);
      // print_r($categories);
      // die;
      if($categories){
         $check['categories'] = $categories;  
         $response = array(
         'status' => true,
         'data' => $check    
         );  
      } else {
        $response = array(
            'status' => false,
            'message' => 'No categories found'    
            ); 
      }
      Yii::$app->response->format = Response::FORMAT_JSON;
      return $response; 
    }
}