<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrestamosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bienvenido al Control de Prestamos';

?>
<div class="index-report">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<div class="tabla" align="center">
		<h3>Prestamos fuera de tiempo</h3>

		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'columns' => [
				'id',
				'cedula',
				'codigo',
				[
				   'attribute' => 'fecha_prestamo',
					'format' =>  ['date', 'php:d/m/Y'],
				   'options' => ['width' => '70']
				],
				[
				   'attribute' => 'fecha_devolucion',
					'format' =>  ['date', 'php:d/m/Y'],
				   'options' => ['width' => '70']
				],
				[
				   'attribute' => 'fecha_entregado',
					'format' =>  ['date', 'php:d/m/Y'],
				   'options' => ['width' => '70']
				],
				[
				   'attribute' => 'estatus',
				   'options' => ['width' => '70']
				],
			],
		]); ?>
	</div>

</div>