<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $book_name
 * @property string $author
 * @property float $price
 * @property int $qty
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $created_at
 * @property string|null $updated_at
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_name', 'author', 'price', 'qty'], 'required'],
            [['price'], 'number'],
            [['delete_flag'], 'boolean'],
            [['qty', 'created_by', 'updated_by'], 'integer'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'safe'],
            [['book_name', 'author'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_name' => 'Book Name',
            'author' => 'Author',
            'price' => 'Price',
            'qty' => 'Qty',
            'delete_flag' => 'Delete Flag',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BookQuery(get_called_class());
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public static function searchByKeyword($keyword, $type = null)
    // {
    //     // foreach (self::$users as $user) {
    //     //     if ($user['accessToken'] === $token) {
    //     //         return new static($user);
    //     //     }
    //     // }

    //     // return null;
    //     return self::find()->andWhere(['book_name' => $keyword, 'author' => $keyword]);
    // }
}
