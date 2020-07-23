<?php

namespace app\modules\api\models;

use Yii;
use yii\base\Model;
use app\modules\api\resources\BookResource;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class BookSearchForm extends Model
{
    public $keyword;

    public $_books = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['keyword'], 'required'],
        ];
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getBookLists()
    {
        // $this->_books = BookResource::findByUsername($this->username);
        $this->_books = BookResource::find()->andWhere(['book_name' => $this->keyword])->orWhere(['author' => $this->keyword])->all();
        return $this->_books;
    }
}
