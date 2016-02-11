<?php

namespace app\models;

use Yii;
use app\models\DepartamentosSearch;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use app\models\Status;
/**
 * This is the model class for table "usuarios".
 *
 * @property string $cedula
 * @property string $nombre
 * @property integer $id_status
 * @property integer $departamento
 * @property string $email
 * @property string $fecha_suspension
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cedula','nombre', 'email', 'id_departamento'], 'required', 'message'=>'Campo requerido'],
            [['id_status', 'id_departamento'], 'integer'],
            [['fecha_suspension'], 'safe'],
            [['cedula'], 'string', 'max' => 20],
            [['nombre'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 50],
			['email', 'email','message'=>'Formato no valido'],
			['cedula', 'existe_cedula']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cedula' => 'Cedula',
            'nombre' => 'Nombre',
            'id_status' => 'Status',
            'id_departamento' => 'Departamento',
            'email' => 'Email',
            'fecha_suspension' => 'Fecha Suspension',
        ];
    }
	
	public function relations(){
         return array(
                    'departamento' => array(self::BELONGS_TO, 'Departamentos', 'id_departamento'),
					'status' => array(self::BELONGS_TO, 'Status', 'id_status'),
					'prestamos' => array(self::HAS_MANY, 'Prestamos', 'cedula'),
					);
	}
	
	public static function getListDepartamento(){
        $opciones = DepartamentosSearch::find()->asArray()->all();
        return ArrayHelper::map($opciones, 'id', 'descripcion');
    }
	
	
	
	public function existe_cedula($atributo, $params){
		$usuario = Usuarios::findBySql("SELECT * FROM usuarios WHERE cedula = '" . $this->cedula ."'" )->all();	
		if($usuario == null){			
			return true;
		}else{
			$this->addError($atributo, 'La cedula ya esta registrada');
		}
		/*
		$opciones = Usuarios::find()->asArray()->all();		
		$array = ArrayHelper::map($opciones, 'cedula', 'nombre');
		$return = false;
		foreach($array as $value){
			if($this->cedula == $value->cedula){
				$this->addError($atributo, 'La cedula ya esta registrada');
				return true;
			}
		}*/
        return false;
    }
	
	public function getDepartamento(){
		return $this->hasOne(Departamentos::className(),['id' =>'id_departamento']);
	}
	
	public function getStatus(){
		return $this->hasOne(Status::className(),['id' =>'id_status']);
	}
	
	public function updateInactivos(){
		Yii::$app->db
				->createCommand('UPDATE usuarios SET id_status=1, fecha_suspension = NULL WHERE id_status = 2 AND fecha_suspension <= CURDATE() ')
				->execute();

		
	}
	
}
