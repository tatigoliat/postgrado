<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prestamos;

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
            [['id', 'codigo', 'estatus'], 'integer'],
            [['cedula', 'fecha_prestamo', 'fecha_devolucion', 'fecha_entregado'], 'safe'],
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

        $query->andFilterWhere([
            'id' => $this->id,
            'codigo' => $this->codigo,
            //'fecha_prestamo' => $this->fecha_prestamo,
            //'fecha_devolucion' => $this->fecha_devolucion,
            'estatus' => $this->estatus,
			//'fecha_entregado' => $this->fecha_entregado,
        ]);

        $query->andFilterWhere(['like', 'cedula', $this->cedula]);

        return $dataProvider;
    }
	
	
}
