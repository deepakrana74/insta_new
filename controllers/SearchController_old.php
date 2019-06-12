<?php

    namespace app\controllers;

    // use yii\rest\ActiveController;
    use app\models\SubCategories;
    use yii\web\Response;
    use yii\web\Controller;
    use Yii;

    class SearchController extends Controller{

        public $enableCsrfValidation = false; //disable csrf 

        public function actionIndex1() {
            $sub_category_model = new SubCategories; //call the sub_category model
            $keyword = trim(Yii::$app->request->post('keyword'));//get the keyword here
            $limit = Yii::$app->request->post('limit'); //set a limit here
        
         $words = explode(' ',$keyword);
         
         $asd = array();
         foreach($words as $key => $value){
          $url = 'https://query.displaypurposes.com/tag/'.$words[$key];     
          $data = file_get_contents($url);
          $alldatas  = json_decode($data);
        
          $alldata = array_slice($alldatas->results,0,$limit);
          $result = array();
          foreach($alldata as $sad){
            if (!preg_match('/[^A-Za-z0-9]/', $sad->tag)) // '/[^a-z\d]/i' should also work.
            {
              $result[] = '#'.$sad->tag;      
            } 
          }
          //print_r($result); die;
          $asd['categories'][] = array(
            'name' => $value,
            'hashtag' => $result   
            );

            $k = array_rand($result,$limit);
            
            $relevent = array(); 
            for($i=0;$i<count($k);$i++){
               $relevent[] = $result[$k[$i]];
            }
               
         }
         $asd['relevent_tags'] = $relevent;
         
         
         if($result){
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




        // this function deals with single keyword
        public function actionIndex() {
            
            $sub_category_model = new SubCategories; //call the sub_category model
            
            $keyword = trim(Yii::$app->request->post('keyword'));//get the keyword here
            $limit = Yii::$app->request->post('limit'); //set a limit here
            // echo json_encode(array('status'=>false,'message'=>$keyword));
            // die;
            //if keyword is null, return user from here
            if($keyword == null){
                $response = array(
                    'status' => false,
                    'message' => 'Please Enter A Keyword'     
                    );  
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $response;
            }
            
            //here, check if the keyword is consisted of multiple words or not?
            $break_keyword = explode(' ',$keyword);

            //count the number of keywords
            $break_keyword_length = sizeof($break_keyword);
            
            //first of all, check here if the same exact keyword is present in the database
            $hash_tags = $sub_category_model->hashTags($keyword);

            //case 1
            
            if(sizeof($hash_tags) !== 0 && $break_keyword_length === 1){ //if result found and keyword length is =1

                //explode all the hash_tags and store in the container variable hashTag
                $hash_tag_container = explode(',',$hash_tags['hash_tags']);

                if(sizeof($hash_tag_container)!== 30){ // if hashtags are not equal to 30
                        
                    //get the group of the particular keyword from the database
                    $search_keyword_group = $sub_category_model->getKeywordGroup($keyword);

                    //run the query to get the keyword from the same group
                    $get_hashtags_from_same_group_keywords = $sub_category_model->getGroupHashtags($search_keyword_group->sub_category_group, $keyword);

                    $i=0; //initialize i
                    $final_hash_tags = []; //declare an empty array

                    //go through each keyword's hashtag and make them join together collectively
                    foreach($get_hashtags_from_same_group_keywords as $pre_final_hash_tags){
                        
                        //store the hashtags in this array
                        $final_hash_tags[] = explode(',',$pre_final_hash_tags['hash_tags']);
                        $i++; 
                    }    
                    
                    //collect all hashtags in a single array using "call_user_func_array"
                    $collective = call_user_func_array('array_merge', $final_hash_tags);

                    //get the final hashtags and store
                    $final_hash_tag_array = array_merge($hash_tag_container,$collective); 

                    //here get and store the desired hash_tags as per the limit
                    $final_limited_hash_tags = array_slice($final_hash_tag_array,0,$limit); 

                    //return to the json_response function
                    return $this->actionReturnResponse($keyword, $limit, $final_limited_hash_tags);
                }

            }

            //case 2

            elseif(sizeof($hash_tags) !== 0 && $break_keyword_length > 1){ //if result found & keyword length is >1
               
                $case = 2; //case no.2
                return $this->actionMultipleKeywords($keyword, $limit, $case);
                
            }

            //case 3
        
            elseif(sizeof($hash_tags) == 0 && $break_keyword_length === 1){ //if result !found & keyword length is =1
                
                //do anything but I want results... just run Like condition
                $like_hash_tags = $sub_category_model->likeHashTags($keyword);

                if($like_hash_tags == null){
                    $response = array(
                        'status' => false,
                        'message' => 'No result found. Please try another keyword'     
                        );  
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        return $response;
                }

                //explode all the hash_tags and store in the container variable hashTag
                $hash_tag_container = explode(',',$like_hash_tags['hash_tags']); 

                if(sizeof($hash_tag_container)!== 30){ // if hashtags are not equal to 30

                    //get the group of the particular keyword from the database
                    $search_keyword_group = $sub_category_model->getKeywordGroup($like_hash_tags['sub_category_name']);


                    //run the query to get the keyword from the same group
                    $get_hashtags_from_same_group_keywords = $sub_category_model->getGroupHashtags($search_keyword_group->sub_category_group, $like_hash_tags['sub_category_name']);

                    $i=0; //initialize i
                    $final_hash_tags = []; //declare an empty array

                    //go through each keyword's hashtag and make them join together collectively
                    foreach($get_hashtags_from_same_group_keywords as $pre_final_hash_tags){
                        
                        //store the hashtags in this array
                        $final_hash_tags[] = explode(',',$pre_final_hash_tags['hash_tags']);
                        $i++; 
                    }    
                    
                    //collect all hashtags in a single array using "call_user_func_array"
                    $collective = call_user_func_array('array_merge', $final_hash_tags);

                    //get the final hashtags and store
                    $final_hash_tag_array = array_merge($hash_tag_container,$collective); 

                    //here get and store the desired hash_tags as per the limit
                    $final_limited_hash_tags = array_slice($final_hash_tag_array,0,$limit); 

                    //return to the json_response function
                    return $this->actionReturnResponse($keyword, $limit, $final_limited_hash_tags);
                }




                if($hash_tags == null){ // if still results are empty... I can't do anything then..

                    $response = array(
                        'status' => false,
                        'message' => 'No result found. Please try another keyword'     
                        );  
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        return $response;
                }
                else{ //return to the return response function
                    return $this->actionReturnResponse($keyword, $limit, $hash_tags);
                }
            }

            //case 4
    
            elseif(sizeof($hash_tags) == 0 && $break_keyword_length > 1){ // if result !found & keyword length is >1
                
                $case = 4; //declare the case here
                return $this->actionMultipleKeywords($keyword, $limit, $case);
            }
        
        }

        //***************************************************************************************************** *///

        //this function deals with multiple keywords search
        public function actionMultipleKeywords($keyword, $limit, $case) {
            
            $sub_category_model = new SubCategories;

            //here, break the string in multiple keywords?
            $break_keyword = explode(' ',$keyword);
            
            //count the number of keywords
            $break_keyword_length = sizeof($break_keyword); 

            $hash_tags = []; //get an empty array

            $newarr = array();
            $asd = [];

            $initiator=1; $index=0;
            for($initiator; $initiator<=$break_keyword_length; $initiator++){

                if($case == 2){ // if the request is from case 2
                    
                    $hash_tags[] = $sub_category_model->hashTags($keyword); //query to get the result

                    if($hash_tags[$index] !== null){ // if results are found
                        
                        $hash_tag_container = explode(',',$hash_tags[$index]['hash_tags']); //just store the hashtags

                        $break_the_loop = true; //and break the loop

                    }

                }
                elseif($case = 4){ // if the request is from case 4
                
                    $hash_tags[] = $sub_category_model->likeHashTags($break_keyword[$index]);

                    if($hash_tags[$index]==null){ // if still results not found,
                        $response = array(
                            'status' => false,
                            'message' => 'No result found. Please try another keyword'     
                            );  
                            Yii::$app->response->format = Response::FORMAT_JSON;
                            return $response;
                    }
    
                    $hash_tag_container = explode(',',$hash_tags[$index]['hash_tags']); //store all keywords in container

                }
                
                if(sizeof($hash_tag_container) !== 30) { // if hashtags are not equal to 30

                    //get the group of the particular keyword from the database
                    $search_keyword_group = $sub_category_model->getKeywordGroup($hash_tags[$index]['sub_category_name']);

                    //run the query to get the keyword from the same group
                    $get_hashtags_from_same_group_keywords = $sub_category_model->getGroupHashtags($search_keyword_group->sub_category_group, $hash_tags[$index]['sub_category_name']);

                     //go through each keyword's hashtag and make them join together collectively
                    foreach($get_hashtags_from_same_group_keywords as $pre_final_hash_tags){
                        
                        //store the hashtags in this array  
                        $final_hash_tags[] = explode(',',$pre_final_hash_tags['hash_tags']); 
                    }

                    //collect all hashtags in a single array using "call_user_func_array"
                    $collective = call_user_func_array('array_merge', $final_hash_tags);

                    //get the final hashtags and store
                    $final_hash_tag_array = array_merge($hash_tag_container,$collective); 
                        
                    //here get and store the desired hash_tags as per the limit
                    $final_limited_hash_tags = array_slice($final_hash_tag_array,0,$limit); 
                        
                    //return to the json_response function
                    $asd['categories'][] = array(
                        'name' => $hash_tags[$index]['sub_category_name'],
                        'hashtag' => $final_limited_hash_tags 
                        );
                        
                        $k = array_rand($final_limited_hash_tags,$limit);
                        
                        $relevent = array();
                        for($i=0;$i<count($k);$i++){
                           $asd['relevent_tags'][] = trim($final_limited_hash_tags[$k[$i]]);
                        }
                        
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
                    if(isset($break_the_loop)){ // if loop breaking is 'on'
                        $case = 4;
                        $revisit = true;
                        return $this->actionMultipleKeywords($keyword, $limit, $case);
                    }   
                    $index++; // increase the value of index by 1
                }
            }

            if($asd){
                $response = array(
                    'status' => true,
                    'data' => $asd    
                    );  
            } else {
                $response = array(
                    'status' => false,
                    'message' => 'Nothing'    
                    ); 
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $response;

        }
// ******************************************************************************************************************//

        //response of the result function
        public function actionReturnResponse($keyword, $limit, $final_limited_hash_tags){

            $asd['categories'][] = array(
                    'name' => $keyword,
                    'hashtag' => $final_limited_hash_tags 
                    );
        
                    $k = array_rand($final_limited_hash_tags,$limit);
                    
                    $relevent = array(); 
                    for($i=0;$i<count($k);$i++){
                       $relevent[] = $final_limited_hash_tags[$k[$i]];
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

        //***********************************************************************************************/
    }

?>