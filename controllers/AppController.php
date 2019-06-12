<?php

namespace app\controllers;

define('Admin', 7);



use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\UserType;

class AppController extends Controller
{
    public $userData; // Holds an activeRecord with current user. NULL if guest

    public $baseUrl = null;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login', 'request-password-reset'],
                'rules' => [
                    [
                        'actions' => ['login', 'request-password-reset'],
                        'allow' => true,
                        'rolls' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'rolls' => ['@'],
                    ],
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    public function init()
    {
        // Load the user
        if (!Yii::$app->user->isGuest) {
            $this->userData = Yii::$app->user->identity;
                        
        }
        if (Yii::$app->request->BaseUrl == "/themes/backend") {
            $this->baseUrl = Yii::$app->request->BaseUrl;
        } else {
            $this->baseUrl = Yii::$app->request->BaseUrl . "/themes/backend";
        }

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '1024M');

        Yii::$app->name = "E-FRA Dashboard";
    }

    # Role Checking Validation
    public function allowOnly($roll_level)
    {
        $current_level = -1;
        if ($this->userData !== null)
            $current_level = $this->userData->user_type_id;
        if ($roll_level != $current_level) {
            $this->layout = "main";
            $this->redirect(array("/site/not-found"));
        }
    }
	
    

	 
}


