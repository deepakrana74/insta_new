<?php
/**
 * Created by PhpStrom.
 * User: Real Developer
 * Date: 04/06/2019
 * Time: 11:00 AM
 */

namespace app\controllers;

use Yii;
use mPDF;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\TestUser;


class SiteController extends AppController
{
    /**
     * @inheritdoc
     */
	public $layout='main';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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

    # Dashboard Login Page
    public function actionIndex()
    {
        $this->redirect(array("/site/login"));
    }

	 /**
     * Login action.
     *
     * @return string
     */

    # Dashboard Login Action Page
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) 
		{
           
            if ($model->login()) 
            {
				 $userType=$model->getUserType();
                 $Details = Yii::$app->request->post();
                 $Email = $Details['LoginForm']['email'];
                 $UserDetail =  User::findByEmail($Email);
                 $UserId =  $UserDetail['id'];

				 switch($userType)
				 {
					case 7: return $this->redirect(['admin/index']); break;
					default : return $this->redirect(['site/not-found']); break;
				 }
            } else {
                
                
                if ($model->getStatus() == 0)
                {
                    \Yii::$app->getSession()->setFlash('err', 'You Are Not Authorized For Login.');
                }  else {
                    \Yii::$app->getSession()->setFlash('err', 'Invalid User or Password');
                }
                
                return $this->refresh();
            }
        } else { 
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    # Dashboard Signout
    public function actionSignout()
    {
		Yii::$app->user->logout();
		$session = Yii::$app->session;
		$session->destroy();
        return $this->redirect(['site/login']);
    }

     # Not Found Page
	 public function actionNotFound()
    {
        $this->layout = "error";
        return $this->render('not-found');
    }
}
