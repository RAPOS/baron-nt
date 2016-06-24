<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BMastersforwomen */
$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Для милых дам', 'url' => ['/admin/mastersforwomen']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_master]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bmasters-update" style="width: 700px;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
