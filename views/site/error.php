<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$baseUrl = Yii::$app->request->baseUrl . "/web";
$baseUrl1 = Yii::$app->request->baseUrl;
AppAsset::register($this);
?>
<!-- Error Content -->
       
             <main id="content" class="error-container" role="main">
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-xs-10 col-lg-offset-4 col-sm-offset-3 col-xs-offset-1">
                        <div class="error-container">
                            <h1 class="error-code">404</h1>
                            <p class="error-info">
                                Opps, it seems that this page does not exist.
                            </p>
                            <p class="error-help mb">
                                If you are sure it should, search for it.
                            </p>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Search Pages">
                            </div>
                            <a href="#" class="btn btn-transparent">
                                Search <i class="fa fa-search text-warning ml-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </main>

        <!-- END Error Content -->
