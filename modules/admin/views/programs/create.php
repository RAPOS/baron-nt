<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BTypesOfMassage */

$this->params['breadcrumbs'][] = ['label' => 'Программы', 'url' => ['/admin/programs']];
$this->params['breadcrumbs'][] = 'Добавить программу';
?>
<div class="btypes-of-massage-create" style="width: 700px;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>