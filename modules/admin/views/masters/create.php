<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BMasters */

$this->params['breadcrumbs'][] = ['label' => 'Мастера', 'url' => ['/admin/masters']];
$this->params['breadcrumbs'][] = 'Добавить мастера';
?>
<div class="bmasters-create" style="width: 700px;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
