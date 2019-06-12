<?php

/**
 * Created by PhpStrom.
 * User: Real Developer
 * Date: 04/06/2019
 * Time: 11:00 AM
 */


/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$baseUrl1 = Yii::$app->request->baseUrl . "/themes/backend/insta/";
$baseUrl = Yii::$app->request->baseUrl;
//AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" id="extr-page">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title> Insta Dashboard</title>
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl1?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl1?>css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl1?>css/smartadmin-production-plugins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl1?>css/smartadmin-production.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl1?>css/smartadmin-skins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl1?>css/smartadmin-rtl.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $baseUrl1?>css/demo.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
		<?php $this->head() ?>
</head>
<body class="animated fadeInDown">
<?php $this->beginBody() ?>
<header id="header">

    <div id="logo-group">
        <span id="logo"> <img src="<?= $baseUrl1?>img/1024.png" alt="#Insta2000"> </span>
    </div>

</header>

<div id="main" role="main">
		<?= $content ; ?>
			
    </div>
<!--================================================== -->

<script src="<?= $baseUrl1?>js/plugin/pace/pace.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script> if (!window.jQuery) { document.write('<script src="<?= $baseUrl1?>js/libs/jquery-2.1.1.min.js"><\/script>');} </script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script> if (!window.jQuery.ui) { document.write('<script src="<?= $baseUrl1?>js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>
<script src="<?= $baseUrl1?>js/app.config.js"></script>
<script src="<?= $baseUrl1?>js/bootstrap/bootstrap.min.js"></script>
<script src="<?= $baseUrl1?>js/plugin/jquery-validate/jquery.validate.min.js"></script>
<script src="<?= $baseUrl1?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>
<script src="<?= $baseUrl1?>js/app.min.js"></script>
<script type="text/javascript">
    runAllForms();

    $(function() {
        // Validation
        $("#login-form").validate({
            // Rules for form validation
            rules : {
                email : {
                    required : true,
                    email : true
                },
                password : {
                    required : true,
                    minlength : 3,
                    maxlength : 20
                }
            },

            // Messages for form validation
            messages : {
                email : {
                    required : 'Please enter your email address',
                    email : 'Please enter a VALID email address'
                },
                password : {
                    required : 'Please enter your password'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });
    });
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
