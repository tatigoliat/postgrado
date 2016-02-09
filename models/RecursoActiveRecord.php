<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class RecursoActiveRecord extends ActiveRecord{
    public $codigo;
	public $titulo;
    public $autor;
    public $tipo_recurso;
    public $total_existente;

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
        return 'recursos';
    }
 
}
