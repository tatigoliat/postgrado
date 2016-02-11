<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prestamos;
use app\models\Usuarios;
use app\models\Recursos;
use app\models\Status;
/**
 * PrestamosSearch represents the model behind the search form about `app\models\Prestamos`.
 */
class PrestamosSearch extends Prestamos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['cedula', 'fecha_prestamo', 'fecha_devolucion', 'fecha_entregado','codigo', 'id_status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Prestamos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		$query->joinWith('status');
		$query->joinWith('usuario');
		$query->joinWith('recurso');
        $query->andFilterWhere([
            'prestamos.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'status.descripcion_status', $this->id_status])
				->andFilterWhere(['like', 'usuarios.nombre', $this->cedula])
				->andFilterWhere(['like', 'recursos.titulo',$this->codigo]);

        return $dataProvider;
    }
	
	public function report($params){  
		
		$query = Prestamos::find();
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'codigo' => $this->codigo,
            'id_status' => 3,
        ]);
		
		$query->andWhere('fecha_devolucion <  CURDATE() ');
        $query->andFilterWhere(['like', 'cedula', $this->cedula]);

        return $dataProvider;
    }
	
}
