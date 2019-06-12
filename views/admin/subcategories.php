<?php

    use app\models\MainCategories;
    use yii\helpers\Url;
    use app\assets\DataTableAsset;
    use app\assets\AppAsset;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    //call the assets
    AppAsset::register($this);

    $baseUrl = Url::base(); //get base url

?>
     <!-- MAIN PANEL -->
<div id="main" role="main">

<!-- RIBBON -->
<div id="ribbon">

            <span class="ribbon-button-alignment">
                <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                    <i class="fa fa-refresh"></i>
                </span>
            </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Home</li><li>Manage Category</li><li>All Category</li>
    </ol>
</div>
<!-- END RIBBON -->

<!-- MAIN CONTENT -->
<div id="content">

    <!-- row -->
    <div class="row">

        <!-- col -->
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa fa-lg fa-fw fa fa-cubes"></i>Manage Category<span>>All Category</span>
            </h1>
        </div>
    </div>

    <?php if (Yii::$app->session->getFlash('err')) {
            ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?= Yii::$app->session->getFlash('err'); ?>
            </div>
        <?php } ?>
        <?php if (Yii::$app->session->getFlash('err1')) {
            ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?= Yii::$app->session->getFlash('err1'); ?>
            </div>
        <?php } ?>
        <?php if (Yii::$app->session->getFlash('success')) {
            ?>
            <div class="alert alert-success" role="alert">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?= Yii::$app->session->getFlash('success'); ?>
            </div>
        <?php } ?>
        
    <!-- end row -->
    <a href="<?=$baseUrl?>/themes/backend/insta/fashion.csv"><button class="btn btn-lg btn-primary btn-block down_csv">Download Reference CSV</button></a>
    <?php $form = ActiveForm::begin(['action' => ['admin/upload-tag-submit'],'options' => ['enctype'=>'multipart/form-data','class'=>"form-horizontal form-label-left"]]); ?>
 
    <?= $form->field($DATA['model'],'file')->fileInput(['required'=>'required'])->label(false) ?>

    <?= Html::submitButton('Upload CSV',['class'=>'up_btn btn btn-lg btn-success btn-block']) ?>
  
    <?php ActiveForm::end(); ?>
   

        <input type="hidden" id="baseUrl" value="<?=$baseUrl?>/admin/delete-subcategory"/>
<table id="datatable_col_reorder" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th data-hide="phone">Sr No.</th>
        <th data-class="expand">Category Name</th>
        <th data-hide="phone,tablet">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1;foreach($DATA['all_sub_categories'] as $sub_categories){ ?>
    <tr id="sub_<?=$sub_categories['id']?>">
        <td><?= $i;?></td>
        <td><?=$sub_categories['sub_category_name']?></td>
        
        <td>
        <a href="<?=$baseUrl?>/admin/edit-sub-category?id=<?=$sub_categories['id']?>"><i class="fa fa-edit" aria-hidden="true"></i></a>

        <a class="delete_subcategory" id="<?=$sub_categories['id']?>" href="#"><i class="fa fa-trash-o" style="margin-right: 12px;"></i></a>
        </td>
    </tr>
    <?php  $i++; } ?>
    </tbody>
</table>

    </div>

</div>
<style>

.form-group.field-csvform-file.required {
    border: 1px solid;
    display: inline-block;
    margin: 0 10px 6px;
    padding: 9px 7px 2px 8px;
    background: #e1e1e15e;
}

.up_btn {
    float: right;
    width: auto;
}form#w0 {
    float: right;
}
.down_csv {
    float: right;
    display: inline-block;
    width: auto;
    margin-left: 10px;
}
</style>