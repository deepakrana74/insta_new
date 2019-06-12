<?php

/**
 * Created by PhpStrom.
 * User: Real Developer
 * Date: 04/06/2019
 * Time: 11:00 AM
 */


namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\CsvForm;
use yii\web\UploadedFile;
use app\models\UploadFile;
use app\models\InstaUsers;
use app\models\SubCategories;
use app\models\MainCategories;
use yii\helpers\Url;



class AdminController extends AppController
{
    /**
     * @inheritdoc
     */
    public $layout = "backend";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
       

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    
    public function actionIndex()
    {
		 $this->allowOnly(7);
         return $this->render('index');
    }


    public function actionAddSubCategory()
    {
        $this->allowOnly(7);
        if (Yii::$app->request->post())
        {
            $DATA        = Yii::$app->request->post();
            $CheckCategory = SubCategories::find()->where(['sub_category_name'=>$DATA['title']])->count();
            if($CheckCategory==0) {
              
                $Tags = explode(',',$DATA['tags']);
                $NHashTags = array();
                $HashTags = array();
                $HashTagsArray = $this->CheckHashTags($HashTags);

                for($i=0;$i<count($Tags);$i++)
                {
                     if(!in_array($Tags[$i],$HashTagsArray)) 
                    {
                        $HashTags[] = $Tags[$i];
                    } else {
                        $NHashTags[] = $Tags[$i];
                    } 
                }

                $SubCategoriesmodel = new SubCategories();
                $SubCategoriesmodel->sub_category_name = $DATA['title'];
                $SubCategoriesmodel->sub_category_group = 1;
                $SubCategoriesmodel->main_category_id = 1;
                $SubCategoriesmodel->hash_tags = implode(',',$HashTags);

                if ($SubCategoriesmodel->save()) {
                    \Yii::$app->getSession()->setFlash('success', 'Category Details Added Successfully');
                     $Utest = implode(',',$NHashTags);
                    if(isset($Utest) && !empty($Utest))
                           {
                                \Yii::$app->getSession()->setFlash('err', 'Some tags has already exists : '.$Utest);
                           }
                    return $this->render('addcategory');
                } else {
                    \Yii::$app->getSession()->setFlash('err', 'Category Details not added');
                    return $this->render('addcategory');
                }
            } else {

                \Yii::$app->getSession()->setFlash('err1', 'Sorry! This category Details has already added');
                return $this->render('addcategory');
            }
        } else {

            return $this->render('addcategory');
        }
    }

       # Edit SubCategory
       public function actionEditSubCategory()
       {
            $this->allowOnly(7);
           if (Yii::$app->request->post())
           {
               $SubCategories  = new SubCategories();
               $DATA = Yii::$app->request->post();
            $CheckCategory = SubCategories::find()->where(['sub_category_name'=>$DATA['title']])->andWhere(['<>','id',$DATA['id']])->count();
                       if ($CheckCategory == 0)
                       {

                            $Tags = explode(',',$DATA['tags']);
                            $NHashTags = array();
                            $HashTags = array();
                            $HashTagsArray = $this->CheckHashTags($HashTags,$DATA['id']);
            
                            for($i=0;$i<count($Tags);$i++)
                            {
                                if(!in_array($Tags[$i],$HashTagsArray)) 
                                {
                                    $HashTags[] = $Tags[$i];
                                } else {
                                    $NHashTags[] = $Tags[$i];
                                } 
                            }
        
                           $SubCategoriesmodel = SubCategories::findOne(['id' =>$DATA['id']]);
                           $SubCategoriesmodel->sub_category_name = $DATA['title'];
                           $Tags = explode(',',$DATA['tags']);
                           $HashTags = array();
                           for($i=0;$i<count($Tags);$i++)
                           {
                               $HashTags[] = $Tags[$i];
                           }

                           $SubCategoriesmodel->hash_tags = implode(',',$HashTags);
                           $SubCategoriesmodel = $SubCategoriesmodel->update();
   
                           \Yii::$app->getSession()->setFlash('success', 'Congrats! Category Details Updated Successfully!');
                           $Utest = implode(',',$NHashTags);
                           if(isset($Utest) && !empty($Utest))
                           {
                                \Yii::$app->getSession()->setFlash('err', 'Some tags has already exists : '.$Utest);
                           }

                           return $this->redirect('subcategories');
                       } else {
   
                           \Yii::$app->getSession()->setFlash('err1', 'Sorry! This category has already exists');
                           return $this->redirect('subcategories');
                       }
                 
               } else {
                   $id = Yii::$app->request->get()['id'];
                   $DATA['SubCategory'] = SubCategories::find()->where(['id'=>$id])->one();
                   return $this->render('editcategory', ['Data' => $DATA]);
               }
   
           }   

    private function CheckHashTags($HashTags,$id=null)
    {
        if($id)
        {
        $SCategory = SubCategories::find()->where(['<>','id',$id])->all();
        } else {
        $SCategory = SubCategories::find()->all();
        }
        $Array = array();
        foreach($SCategory as $HCategory)
        {
            $Array[] = explode(',',$HCategory->hash_tags);
        }
        $HashTagArray = call_user_func_array('array_merge', $Array);
        return $HashTagArray;

    }
    


    //the subcategories function
    public function actionSubcategories()
    {
        $DATA['model'] = new CsvForm();
        //call the subcategories model
        $sub_category_model = new SubCategories();

        //get all subcategories
        $DATA['all_sub_categories'] = $sub_category_model->getAllSubcategories();

        return $this->render('subcategories',[
                'DATA'=>$DATA,
        ]);
    }   


    public function actionUploadTagSubmit()
    {
        if(Yii::$app->request->post())
        {
                $DATA = Yii::$app->request->post();
                $file = UploadedFile::getInstance(new CsvForm(), 'file');
                $filename = date('his').'.'.$file->extension;
                $upload = $file->saveAs('themes/backend/insta/' . $filename);
                if ($upload) {
                    define('CSV_PATH', 'themes/backend/insta/');
                    $csv_file = CSV_PATH . $filename;
                    $handle = fopen($csv_file, "r");
                    $counter=0;
                   while (($fileop = fgetcsv($handle, 1000, ",")) !== false)
                    {
                        if  (($counter == 0))
                        {

                        } else {
                                
                            if(!isset($fileop[1]))
                            {
                                \Yii::$app->getSession()->setFlash('err', 'Sorry Please Upload File Type CSV with required data also');
                                return $this->redirect(['subcategories']);
                            } else {
                                $Array[] = $fileop;
                                $this->SaveUploadTags($fileop);
                            }
                        }
                        $counter++;
                    }

                }
                \Yii::$app->getSession()->setFlash('success', 'All Records has been uploaded successfully');
                return $this->redirect(['subcategories']);
           
        } else {
            
            \Yii::$app->getSession()->setFlash('err', 'All Records has been uploaded successfully');
            return $this->redirect(['subcategories']);
        }
    }


    private function SaveUploadTags($Data)
    { 
        $CheckCategory = SubCategories::find()->where(['sub_category_name'=>$Data[0]])->count();
        if($CheckCategory==0) 
        {
            $SubCategories = new SubCategories();
            $SubCategories->sub_category_name = $Data[0];
            $SubCategories->hash_tags = utf8_encode($Data[1]);

            return $SubCategories->save();
        }

    }



    //########################################################################################

    //view hashtag function
    public function actionViewHashTags($keyword){

        $baseUrl = Url::base(); //get base url
        
        //call the sub categories model here
        $sub_category_model = new SubCategories();
        
        //get all the hash tags
        $hash_tags = $sub_category_model->hashTags($keyword);

        //exlplode hash tags and store in the array
        $array_hash_tags = explode(',', $hash_tags['hash_tags']);
        
        //render view
        return $this->render('viewHashTags',[
            'array_hash_tags'=>$array_hash_tags,
            'baseUrl' => $baseUrl,
            'keyword_id' => $hash_tags['id'],
        ]);
    }
    
    // ############################################################################

    //delete hash tags function starts here
    public function actionDeleteTags(){

        //call the model here
        $sub_category_model = new SubCategories();
        
        if(Yii::$app->request->post()){ // if data is received
            $data = Yii::$app->request->post(); // store in the variable

            //here get the hashtags for the particular keyword
            $hash_tags = $sub_category_model->hashTagsById($data['keyword_id']);

            //exlplode hash tags and store in the array
            $array_hash_tags = explode(',', $hash_tags['hash_tags']);

            //search for the hashtag in the array
            $key = array_search($data['hashtag'], $array_hash_tags);


            //remove the hashtag from the array
            unset($array_hash_tags[$key]);

            //convert the array to the string
            $new_hash_tags = implode(',', $array_hash_tags);

            //query to update the hashtags
            $update = $sub_category_model->findOne($data['keyword_id']);
            $update->hash_tags =  $new_hash_tags;

            if($update->save())
            {  
                return true; // if record updated, return true
            }
            else{
                
                return json_encode($update->errors); //else return false
            }
        } 
    }


    ##################################################################################################
    
    //delete subcategory function starts here
    public function actionDeleteSubcategory(){

        if(Yii::$app->request->post()){ // if data is posted

            // store in the database
            $data = Yii::$app->request->post();

            //delete query 
            $delete = SubCategories::findOne($data['ID']);
            if($delete->delete()){ // if delete success return true
                echo json_encode('true'); 
            }
            else{ // else return false
                echo json_encode('false');
            }

        }
    }

    ##################################################################################################

    //update category function starts here
    public function actionUpdateSubCategory($keyword_id){

        if(Yii::$app->request->post()){ // if the posted data is received

            $data = Yii::$app->request->post(); //store the posted data

            //query to update sub_categories data
            $update = SubCategories::findOne($keyword_id);

            $update->sub_category_name = $data['SubCategories']['sub_category_name']; //update sub_category_name
            $update->sub_category_group = $data['SubCategories']['sub_category_group']; //update sub_category_group
            
            if(!empty($data['MainCategories']['main_category_name'])){ // if main category is set

                // update main category
                $update->main_category_id = $data['MainCategories']['main_category_name']; 
            }

            if($update->save()){ //save the updates
                
                //set success flash
                Yii::$app->session->setFlash('success', 'Your Changes Have Been Saved');

                //redirect to edit-subcategory 
                return $this->redirect(['edit-subcategory','keyword_id'=>$keyword_id]);
            }
        }
        else{ //else show that page doesn't exist
            die('oops!! This page doesn&#39t exist');
        }
        
    }

   /*  # Dashboard Main Page
 
    # View All Users
    public function actionUsers()
    {
		 $this->allowOnly(7);
         $Data['AllUsers']  = User::find()->where(['user_type_id'=>6])->all();
         return $this->render('allusers',['Data'=>$Data]);
    }

   
    # User Active OR De-Active
    public function actionUserActivated()
    {
        if(Yii::$app->request->isAjax) {
            if (Yii::$app->request->post())
            {
                $Data = Yii::$app->request->post();
                $User = User::findOne(['id'=>$Data['user_id']]);
                $User->status = $Data['status'];
                if($User->update(false))
                {
                    echo json_encode("success");
                }
            }
        }

    } */

}
