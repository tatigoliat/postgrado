<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord; 


class DepartamentoActiveRecord extends ActiveRecord{
    public $id;
	public $descripcion;
	
	private static $items=array();	
	
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
        return 'departamentos';
    }
 
	 public static function items($tipo){
		// Devuelve todos los ítems que forman el arreglo
		if(!isset(self::$_items[$tipo]))
			self::loadItems($tipo);
		return self::$_items[$tipo];
	}
	public static function item($tipo, $id){
		// Devuelve el ítem al que le corresponde el id
		if(!isset(self::$_items[$tipo]))
			self::loadItems($tipo);
		return isset(self::$_items[$tipo][$id]) ? self::$_items[$tipo][$id] : false;
	}

	private static function loadItems($tipo){
		// Obtiene los registros
		self::$_items[$tipo]=array();
		$models=self::model()->findAll(array('order'=>'nombre'));
		foreach($models as $model)
			self::$_items[$tipo][$model->id]=$model->nombre;
	}
}
