<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestamosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prestamos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestamos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Prestamo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			//'id',
			[
			   'attribute' => 'id',
			   'options' => ['width' => '60']
			],

			[
			   'attribute' => 'codigo',
			   'value'=>'recurso.titulo',
			],
			
			[
			   'label' => 'Usuario',
			   'attribute' => 'cedula',
			   'value'=>'usuario.nombre',
			],
			[
			   'attribute' => 'fecha_prestamo',
				'format' =>  ['date', 'php:d/m/Y'],
			   'options' => ['width' => '50']
			],
			[
			   'attribute' => 'fecha_devolucion',
				'format' =>  ['date', 'php:d/m/Y'],
			   'options' => ['width' => '50']
			],
			[
			   'attribute' => 'fecha_entregado',
				'format' =>  ['date', 'php:d/m/Y'],
			   'options' => ['width' => '50']
			],

			[
			   'attribute' => 'id_status',
			   'value'=>'status.descripcion_status',
			   'options' => ['width' => '120']
			],
			
            //'fecha_prestamo',
            //'fecha_devolucion',
			//'fecha_entregado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
		
    ]); ?>

</div>
