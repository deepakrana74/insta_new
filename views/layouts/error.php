<?php

/**
 * Created by Brackets.
 * User: Real Developer
 * Date: 13/06/2017
 * Time: 05:00 PM
 */
 
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$baseUrl = Yii::$app->request->baseUrl . "/web";
$baseUrl1 = Yii::$app->request->baseUrl;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title>not found</title>
        <link rel="shortcut icon" href="">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">

		<link rel="stylesheet" href="<?= $baseUrl?>/broker/css/application.css">
		<?php $this->head() ?>
    </head>
    <body>
	<?php $this->beginBody() ?>
	  <div class="error-page container">
        <?= $content; ?>
		</div>
        <!-- END Error Footer -->
<script src="<?= $baseUrl?>/broker/lib/jquery/dist/jquery.min.js"></script>
<script src="<?= $baseUrl?>/broker/lib/jquery-pjax/jquery.pjax.js"></script>
<script src="<?= $baseUrl?>/broker/lib/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
<script src="<?= $baseUrl?>/broker/lib/widgster/widgster.js"></script>
<script src="<?= $baseUrl?>/broker/lib/underscore/underscore.js"></script>

<!-- common application js -->
<script src="<?= $baseUrl?>/broker/js/app.js"></script>
<script src="<?= $baseUrl?>/broker/js/settings.js"></script>

<!-- common templates -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
