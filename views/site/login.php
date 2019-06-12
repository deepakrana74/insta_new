 <?php
/**
 * Created by PhpStorm.
 * User: Real Developer
 * Date: 13/06/2017
 * Time: 03:30 PM
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$baseUrl = Yii::$app->request->baseUrl . "/themes/backend/insta/";
$baseUrl1 = Yii::$app->request->baseUrl;
?>

 <!-- MAIN CONTENT -->
 <div id="content" class="container">
     <?php if (Yii::$app->session->getFlash('err')) {
         ?>
         <div class="alert alert-warning" role="alert">
             <a href="#" class="close" data-dismiss="alert">&times;</a>
             <?= Yii::$app->session->getFlash('err'); ?>
         </div>
     <?php } ?>
     <?php if (Yii::$app->session->getFlash('register')) {
         ?>
         <div class="alert alert-success" role="alert">
             <a href="#" class="close" data-dismiss="alert">&times;</a>
             <?= Yii::$app->session->getFlash('register'); ?>
         </div>
     <?php } ?>
     <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
             <h1 class="txt-color-red login-header-big">#Insta2000</h1>
             <div class="hero">

                 <div class="pull-left login-desc-box-l">
                     <h4 class="paragraph-header">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h4>
                 </div>

                 <img src="<?= $baseUrl?>img/demo/iphoneview.png" class="pull-right display-image" alt="" style="width:210px">

             </div>

             <div class="row">
                 <div class="col-xs-12 col-sm-12">
                     <h5 class="about-heading">About #Insta2000</h5>
                     <p>
                         It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                     </p>
                 </div>
             </div>

         </div>
         <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
             <div class="well no-padding">
                 <?php $form = ActiveForm::begin(array('action' => ['site/login'], 'options' => array('method' => 'post', 'id'=>'login-form','class'=>"smart-form client-form",))); ?>
                 <header> Sign In </header>
                 <fieldset>
                     <section>
                         <label class="label">Email</label>
                         <label class="input"> <i class="icon-append fa fa-user"></i>
                             <?= $form->field($model, 'email')->textInput(['placeholder' => 'Your Email Id','id'=>'email','type'=>'email'])->label(false); ?>                <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Enter Your Email </b></label>
                     </section>

                     <section>
                         <label class="label">Password</label>
                         <label class="input"> <i class="icon-append fa fa-lock"></i>
                             <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password','id'=>'password'])->label(false); ?>
                             <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter Your Password</b> </label>
                     </section>

                 </fieldset>
                 <footer>
                     <?= Html::submitButton("<small>Sign In</small>", ['class' => 'btn btn-primary', 'name' => 'login-button','type'=>'submit']) ?>
                     </footer>
                 <?php ActiveForm::end(); ?>
             </div>

         </div>
     </div>
 </div>