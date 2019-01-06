<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;
use Yii;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Model
{
    public $id;
    public $username;
    public $currency_id;
    public $amount_from;
    public $amount_to;
    public $message;
    public $created_at_from;
    public $created_at_to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'currency_id'], 'integer'],
            [['amount_from', 'amount_to'], 'number'],
            [['username', 'message'], 'safe'],
            [['created_at_from', 'created_at_to'], 'match',
                'pattern' => '/^\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d$/',
                'message' => Yii::t('app', 'Format: "YYYY-mm-dd HH:ii:ss"'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'currency_id' => Yii::t('app', 'Currency'),
            'amount_from' => Yii::t('app', 'Amount From'),
            'amount_to' => Yii::t('app', 'Amount To'),
            'message' => Yii::t('app', 'Message'),
            'created_at_from' => Yii::t('app', 'Created From'),
            'created_at_to' => Yii::t('app', 'Created To'),
        ];
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
        $query = Order::find()->alias('o');

        // avoid N+1 problem in grid
        $query->with('user');
        $query->with('currency');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['defaultPageSize' => 2],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere([
            'o.id' => $this->id,
            'o.currency_id' => $this->currency_id,
        ]);


        $query->andFilterWhere(['>=', 'o.created_at', ($this->created_at_from ? strtotime($this->created_at_from) : null)]);
        $query->andFilterWhere(['<=', 'o.created_at', ($this->created_at_to ? strtotime($this->created_at_to) : null)]);

        $query->andFilterWhere(['>=', 'o.amount', $this->amount_from]);
        $query->andFilterWhere(['<=', 'o.amount', $this->amount_to]);

        $query->andFilterWhere(['like', 'o.message', $this->message]);

        $query->joinWith('user u');
        $query->andFilterWhere(['like', 'u.username', $this->username]);

        return $dataProvider;
    }

    /**
     * Return true if any filter is set
     * @return bool
     */
    public function hasFilters()
    {
        foreach ($this->getAttributes() as $field => $value) {
            if (!empty($value)) {
                return true;
            }
        }

        return false;
    }
}
