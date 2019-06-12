<?php
/**
 * Created by PhpStrom.
 * User: Real Developer
 * Date: 04/06/2019
 * Time: 11:00 AM
 */

use yii\helpers\Html;
$baseUrl1 = Yii::$app->request->baseUrl;
$baseUrl = Yii::$app->request->baseUrl . "/themes/backend/insta/";
?>
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it -->

					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
						<img src="<?= $baseUrl;?>img/avatars/sunny.png" alt="me" class="online" />
						<span>
							<?= Yii::$app->user->identity->name;?>
						</span>
						<i class="fa fa-angle-down"></i>
					</a>

				</span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive-->
    <nav>
        <ul>
            <li class="<?= Yii::$app->controller->action->id=='index' ? 'active' : ''?>">
                <a href="<?= $baseUrl1?>/admin" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
			<li class="<?= Yii::$app->controller->action->id=='add-sub-category' ? 'class="active"' : ''?>">
				<a href="#"><i class="fa fa-lg fa-fw fa fa-cubes"></i> <span class="menu-item-parent">Manage Category</span></a>
				<ul <?= Yii::$app->controller->action->id!='index' ? 'style="display:block"' : 'style="display:none"'?>>
					<li <?= Yii::$app->controller->action->id=='add-sub-category' ? 'class="active"' : ''?>><a href="<?= $baseUrl1?>/admin/add-sub-category"> Add Category & hash Tags</a></li>
					<li <?= Yii::$app->controller->action->id=='subcategories' ? 'class="active"' : ''?>> <a href="<?= $baseUrl1?>/admin/subcategories">All Category</a></li>
				</ul>
			</li>

			<li class="<?= Yii::$app->controller->action->id=='pages' ? 'class="active"' : ''?>">
				<a href="<?= $baseUrl1?>/admin/pages"><i class="fa fa-lg fa-fw fa fa-gears"></i> <span class="menu-item-parent">Manage Setting</span></a>
				
			</li>
        </ul>
    </nav>
			<span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>