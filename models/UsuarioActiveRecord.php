<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord; 


class UsuarioActiveRecord extends ActiveRecord{
    public $cedula;
	public $nombre;
    public $email;
    public $departamento;
    public $estatus;
	public $fecha_suspension;

    /**
     * @return array the validation rules.
     */
    public static function getDb(){
        return Yii::$app->db;
    }

	/**
     * @return array the validation rules.
     */
    public static function tableName(){
        return 'usuarios';
    }
 
}
