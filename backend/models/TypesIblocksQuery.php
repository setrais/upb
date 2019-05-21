<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[TypesIblocks]].
 *
 * @see TypesIblocks
 */
class TypesIblocksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TypesIblocks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TypesIblocks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
