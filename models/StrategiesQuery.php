<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Strategies]].
 *
 * @see Strategies
 */
class StrategiesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Strategies[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Strategies|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
