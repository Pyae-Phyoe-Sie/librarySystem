<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Books]].
 *
 * @see \app\models\Books
 */
class BookQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Books[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Books|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Books|array|null
     */
    public function byKeyword($request)
    {
        $keyword = $request->get('keyword');
        if ($keyword == "info") {
            return $this->andWhere(['id' => $request->get('id')]);
        }
        if ($keyword == "") {
            return $this->andWhere(['<>', 'book_name', $keyword])->orWhere(['<>', 'author', $keyword]);
        }
        return $this->andWhere(['like', 'book_name', $keyword])->orWhere(['like', 'author', $keyword]);
    }
}
