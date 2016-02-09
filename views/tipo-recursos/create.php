<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoRecursos */

$this->title = 'Create Tipo Recursos';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Recursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-recursos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
