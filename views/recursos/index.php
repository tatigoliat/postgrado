<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecursosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recursos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recursos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir Recurso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'titulo',
            'autor',
            //'id_tipo_recurso',
			[
			   'attribute' => 'id_tipo_recurso',
			   'value'=>'tipoRecurso.tipo_recurso',
			   'options' => ['width' => '100']
			],
            //'total_existente',
			//'total_disponible',
			[
			   'attribute' => 'total_existente',
			   'value'=>'total_existente',
			   'options' => ['width' => '50']
			],
			[
			   'attribute' => 'total_disponible',
			   'value'=>'total_disponible',
			   'options' => ['width' => '50']
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
