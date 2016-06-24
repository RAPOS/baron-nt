<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BMastersforwomen */
$this->title = 'Добавить мастера';
$this->params['breadcrumbs'][] = ['label' => 'Для милых дам', 'url' => ['/admin/mastersforwomen']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bmasters-create" style="width: 700px;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
