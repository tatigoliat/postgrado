<?php

namespace app\models;

use Yii;
use yii\base\Model;


class ModelUsuario extends Model{
    public $cedula;
	public $nombre;
    public $email;
    public $departamento;
    public $estatus;
	public $fecha_suspension;

    /**
     * @return array the validation rules.
     */
    public function rules(){
        return [
            // name, email, subject and body are required
            [['cedula','nombre', 'email', 'departamento'], 'required', 'message'=>'Campo requerido'],
            // email has to be a valid email address
            ['email', 'email','message'=>'Formato no valido'],
			['cedula', 'existe_cedula'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels(){
        return [
            'nombre' => 'Nombre: ',
			'cedula' => 'Cedula: ',
			'departamento' => 'Departamento: ',
			'email' => 'Email: ',
        ];
    }
	
	public function existe_cedula($atributo, $params){
		$return = false;
		$array = ['19481926','8830563','5374269'];
		foreach($array as $value){
			if($this->cedula == $value){
				$this->addError($atributo, 'La cedula ya esta registrada');
				return true;
			}
		}
        return $return;
    }
	
	

 
}
