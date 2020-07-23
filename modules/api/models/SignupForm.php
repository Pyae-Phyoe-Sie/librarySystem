<?php

namespace app\modules\api\models;

use Yii;
use yii\base\Model;
use app\modules\api\resources\UserResource;

/**
 * SignupForm is the model behind the signup form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;

    public $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['username', 'unique',
                'targetClass'   => '\app\modules\api\resources\UserResource',
                'message'       => 'The username is already exit.'
            ],
            [['username', 'password', 'password_repeat'], 'required'],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
            // rememberMe must be a boolean value
            // ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            // ['password', 'validatePassword'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        $this->_user = new UserResource();
        if ($this->validate()) {
            $this->_user->username = $this->username;
            $this->_user->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
            $this->_user->access_token = \Yii::$app->security->generateRandomString(255);
            if ($this->_user->save()) {
                return true;
            }
            return false;
            // return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
}
