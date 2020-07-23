<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\Cors;
use app\modules\api\models\LoginForm;
use app\modules\api\models\SignupForm;

class ProjectController extends Controller
{

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'cors' => Cors::class
        ]);
    }

    public function actionLogin()
    {
        // echo $this->renderContent("Hello");
        // if (!Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            // return $this->goBack();
            return $model->getUser();
        }

        // $model->password = '';
        // return $this->render('login', [
        //     'model' => $model,
        // ]);

        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->errors
        ];
        
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->register()) {
            // return $this->goBack();
            return $model->_user;
        }

        // $model->password = '';
        // return $this->render('login', [
        //     'model' => $model,
        // ]);

        Yii::$app->response->statusCode = 422;
        return [
            'errors' => $model->errors
        ];
    }
}