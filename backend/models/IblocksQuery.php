<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Iblocks]].
 *
 * @see Iblocks
 */
class IblocksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Iblocks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Iblocks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
