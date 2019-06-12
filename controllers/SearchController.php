<?php

    namespace app\controllers;

    // use yii\rest\ActiveController;
    use app\models\SubCategories;
    use app\models\Pages\Pages;
    use app\models\MainCategories;
    use yii\web\Response;
    use yii\web\Controller;
    use Yii;

    class SearchController extends Controller {

        public $enableCsrfValidation = false; //disable csrf 


        //response of the result function
        public function actionReturnResponse($keyword, $limit, $final_limited_hash_tags){

            $asd['categories'][] = array(
                    'name' => $keyword,
                    'hashtag' => $final_limited_hash_tags 
                    );
                    if(count($final_limited_hash_tags)>$limit){
                     $k = array_rand($final_limited_hash_tags,$limit);  
                    } else {
                     $k = array_rand($final_limited_hash_tags,count($final_limited_hash_tags)); 
                    }
                    
                    $relevent = array(); 
                    for($i=0;$i<count($k);$i++){
                       if(count($k)>1){
                         $relevent[] = $final_limited_hash_tags[$k[$i]];
                       } else {
                         $relevent[] = $final_limited_hash_tags[$k];
                       }
                       
                    }
                       
                 $asd['relevent_tags'] = $relevent;
                 
                 
                 if($final_limited_hash_tags){
                   $response = array(
                   'status' => true,
                   'data' => $asd    
                   );
                 } else {
                   $response = array(
                   'status' => false,
                   'message' => 'No tags found'     
                   );  
                 }
                 Yii::$app->response->format = Response::FORMAT_JSON;
                 return $response;
        }



        /***** New Search Function ******/

        public function actionIndex() { 
         $sub_category_model = new SubCategories; //call the sub_category model
         $main_category_model = new MainCategories; //call the main_category model

         $keyword = trim(Yii::$app->request->post('keyword'));//get the keyword here
         $limit = Yii::$app->request->post('limit'); //set a limit here
         //$method = Yii::$app->request->post('method'); //Auto or Manual
         
         if($keyword == null) {
          $response = array(
          'status'=>false,
          'message'=>'Please enter keywords to search'	
          );
          Yii::$app->response->format = Response::FORMAT_JSON;
          return $response;
         }

         $keywords = explode(',',$keyword);
         
         $response = $sub_category_model->hashTagSearch($keywords,$limit);
         // print_r($response);
         // die;
         if($response) {
           $data = array(
                   'status' => true,
                   'data' => $response
            	   );
           Yii::$app->response->format = Response::FORMAT_JSON;
	       return $data;
         } else { 
           $data = array(
           		   'status' => false,
           		   'message' => 'No hash tags found'	
           	       );
           Yii::$app->response->format = Response::FORMAT_JSON;
	       return $data;
         } 
        
        }

    //***********************************************************************************************/



   public function actionMyFunction() { 
         $sub_category_model = new SubCategories; //call the sub_category model
         $main_category_model = new MainCategories; //call the main_category model

         $keyword = trim(Yii::$app->request->post('keyword'));//get the keyword here
         $limit = Yii::$app->request->post('limit'); //set a limit here
         //$method = Yii::$app->request->post('method'); //Auto or Manual
         
         if($keyword == null) {
          $response = array(
          'status'=>false,
          'message'=>'Please enter keywords to search'	
          );
          Yii::$app->response->format = Response::FORMAT_JSON;
          return $response;
         }

         $keywords = explode(',',$keyword);
         
         $response = $sub_category_model->Search($keywords,$limit);
         // print_r($response);
         // die;
         if($response) {
           $data = array(
                   'status' => true,
                   'data' => $response
            	       );
           Yii::$app->response->format = Response::FORMAT_JSON;
	       return $data;
         } else { 
           $data = array(
           		   'status' => false,
           		   'message' => 'No hash tags found'	
           	       );
           Yii::$app->response->format = Response::FORMAT_JSON;
	       return $data;
         } 
        
        }




        /***** Page Data Function ******/

        public function actionPage() 
        { 
          $Pages = new Pages; //call the Pages model
 
          
          if(Yii::$app->request->post()) 
          {
            $page_id = Yii::$app->request->post('page_id'); //set a page_id here
            $PageInfo = Pages::find()->where(['id'=>$page_id])->select('Content')->one();

            $response = array(
              'status'=>True,
              'message'=>'Page Info',
              'data'  => $PageInfo->Content
              );
             Yii::$app->response->format = Response::FORMAT_JSON;
             return $response;

          
          } else {

            $response = array(
              'status'=>false,
              'message'=>'Please enter page_id'	
              );
             Yii::$app->response->format = Response::FORMAT_JSON;
             return $response;
          }
         }
    }

?>