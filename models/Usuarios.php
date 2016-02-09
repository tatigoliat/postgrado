<?php

namespace app\models;

use Yii;
use app\models\DepartamentosSearch;
use yii\helpers\ArrayHelper;
use app\models\Status;
/**
 * This is the model class for table "usuarios".
 *
 * @property string $cedula
 * @property string $nombre
 * @property integer $estatus
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
            [['cedula','nombre', 'email', 'departamento'], 'required', 'message'=>'Campo requerido'],
            [['estatus', 'departamento'], 'integer'],
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
            'estatus' => 'Estatus',
            'departamento' => 'Departamento',
            'email' => 'Email',
            'fecha_suspension' => 'Fecha Suspension',
        ];
    }
	
	/*public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
                    'FK_rel_departamentos_usuarios' => array(self::BELONGS_TO, 'departamentos', 'id'),
					'FK_rel_status_usuarios' => array(self::BELONGS_TO, 'status', 'id'),
					);
	}*/
	
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
	
}
