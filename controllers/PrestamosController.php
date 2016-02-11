<?php

namespace app\controllers;


use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Prestamos;
use app\models\PrestamosSearch;
use app\models\Usuarios;
use app\models\Recursos;

/**
 * PrestamosController implements the CRUD actions for Prestamos model.
 */
class PrestamosController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Prestamos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrestamosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prestamos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Prestamos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Prestamos();
		$model->fecha_prestamo = date("d-m-Y");		
		
		$nuevafecha = strtotime ( '+3 day' , strtotime ( $model->fecha_prestamo) ) ;
		$model->fecha_devolucion  = date ( 'd-m-Y' , $nuevafecha );
		
		$model->id_status = 3;
  
        if ($model->load(Yii::$app->request->post())){			
			if($model->validate()) {
				$nuevafecha = strtotime ( $model->fecha_prestamo)  ;
				$model->fecha_prestamo  = date ( 'Y-m-d' , $nuevafecha );
				
				$nuevafecha = strtotime ( $model->fecha_devolucion)  ;
				$model->fecha_devolucion  = date ( 'Y-m-d' , $nuevafecha );
				
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
		}
		
		return $this->render('create', ['model' => $model,]);		
    }

    /**
     * Updates an existing Prestamos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post())){			
			if($model->validate()) {				
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}
	return $this->render('update', ['model' => $model,]);	
    }

    /**
     * Deletes an existing Prestamos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionDevolucion($id){		
        $model = $this->findModel($id);
				
		$model->id_status = 4;
		$model->fecha_entregado = date('Y-m-d');
		if($model->save()) {
			$fecha_actual = strtotime(date('Y-m-d'));
			$fecha_entrada = strtotime($model->fecha_devolucion);

			if($fecha_actual > $fecha_entrada){
					$usuario =Usuarios::findOne($model->cedula);
					$usuario->id_status= 2;
					$usuario->update();		

					$recurso =Recursos::findOne($model->codigo);	

					$fecha = strtotime ( '+5 day' , strtotime ( date('Y-m-d')) ) ;
					$activacion  = date ( 'd-m-Y' , $fecha );					

					$content = "<p>Estimado usuario " . $usuario->nombre . ",</p>";
					$content .= "<p>La biblioteca de la institucion le informa que le ha sido suspendido su servicio de prestamo.</p>";
					$content .= "<p>Motivo: Devolucion retardada del recurso: ". $recurso->titulo  . "</p>";
					$content .= "<p>Podra volver a utilizar el servicio a partir de la fecha: ". $activacion . "</p>";
					
					// Enviar mail.			
					Yii::$app->mailer->compose("@app/mail/layouts/html", ["content" => $content])					
							-> setFrom(Yii::$app->params['adminEmail'])
							-> setTo($usuario->email)
							-> setSubject("Notificacion suspension")
							-> setTextBody($content)
							-> setHtmlBody($content)
							-> send();	
			}
			
			return $this->redirect(['view', 'id' => $model->id]);
		}		
		
		return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Prestamos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prestamos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prestamos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
