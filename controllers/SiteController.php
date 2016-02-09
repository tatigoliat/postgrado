<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\response;
use yii\widgets\ActiveForm;

use app\models\LoginForm;
use app\models\ContactForm;

use app\models\ModelUsuario;
use app\models\UsuarioActiveRecord;

use app\models\ModelRecurso;
use app\models\RecursoActiveRecord;

class SiteController extends Controller{
	
	public function actionCrearUsuario(){
        $model = new ModelUsuario();
		$msj = null;
		
		/*if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}*/
		
		if ($model->load(Yii::$app->request->post())){
			if($model->validate()){
				$table = new UsuarioActiveRecord();				
				$table->nombre = $model->nombre;
				$table->cedula = $model->cedula;
				$table->departamento = $model->departamento;
				$table->email = $model->email;	

				$msj = $table->nombre .' '. $table->cedula;
				try {
					if($table->save()){
						$model->nombre=null;
						$model->cedula=null;
						$model->departamento=null;
						$model->email=null;
						$msj = $msj . ' Procesado exitosamente';
					}else{
						$msj = 'Ha ocurrido un error guardando los datos.';
					}			
				
				} catch(\Exception $e) {
					throw $e;
					$msj = 'Ha ocurrido un error guardando los datos.' . $e;
				}
					
				
			}else{
				$msj = $model->getErrors();
			}
		}
        return $this->render('crearusuario', [ 'model' => $model,'msj'=>$msj]);
    }
	
	public function actionVerUsuario(){
		$table= new UsuarioActiveRecord();
		$model= $table->find()->all();
        return $this->render('verusuario',[ 'model' => $model]);
    }
	
	public function actionCrearRecurso(){
        $model = new ModelRecurso();
		$msj = null;
		
		/*if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}*/
		
		if ($model->load(Yii::$app->request->post())){
			if($model->validate()){
				$table = new RecursoActiveRecord();	
				$table->titulo = $model->titulo;
				$table->autor = $model->autor;
				$table->total_existente = $model->total_existente;	
				$table->tipo_recurso = $model->tipo_recurso;

				$msj = $table->titulo .' '. $table->total_existente;
				try {
					if($table->save()){
						$model->codigo=null;
						$model->titulo=null;
						$model->autor=null;
						$model->total_existente=null;
						$model->tipo_recurso=null;
						$msj = 'Procesado exitosamente';
					}else{
						$msj = 'Ha ocurrido un error guardando los datos.';
					}			
				
				} catch(\Exception $e) {
					throw $e;
					$msj = 'Ha ocurrido un error guardando los datos.' . $e;
				}
					
				
			}else{
				$msj = $model->getErrors();
			}
		}
		
        return $this->render('crearrecurso', [
            'model' => $model,'msj'=>$msj
        ]);
    }
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],  
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
