<?php

namespace app\modules\api\controllers;

use Yii;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use app\modules\api\resources\BookResource;
use yii\data\ActiveDataProvider;

use app\modules\api\models\BookSearchForm;

class BookController extends ActiveController
{
    public $modelClass = BookResource::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];
        $behaviors['authenticator']['except'] = ['options'];
        $behaviors['cors'] = [
            'class' => Cors::class
        ];
        return $behaviors;
    }

    public function actions() {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $request = Yii::$app->request;
        
        return new ActiveDataProvider([
            'query' => $this->modelClass::find()->byKeyword($request)
        ]);
    }
}