<?php

namespace app\controllers;

use app\models\AddForm;
use app\models\Phones;
use app\models\search\PhonesSearch;
use Yii;
use yii\data\ActiveDataFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\VarDumper;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //$phones = Phones::find()->all();
        //return $this->render('index', compact('phones'));
        $searchModel = new PhonesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'phones' => Phones::find()->all(),
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    /**
     * Dell db-string.
     *
     * @input number
     */
    public function actionDelete($id)
    {
        $model = Phones::find()->where(['id' => $id])->one();
        // удаляем строку
        $model->delete();
        return $this->redirect('index');
    }

    /**
     * Add db-string.
     *
     * @input array
     */
    public function actionAdd()
    {
        // создаем экземпляр класса
        $model = new AddForm;
        $data = new Phones;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            // save data
            $data->name  = $model->name;
            $data->prise = $model->prise;
            $data->about = $model->about;
            $data->insert();
            //$model->save(false);

            return $this->redirect('index');
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('add-form', ['model' => $model]);
        }
    }

    /**
     * Edit db-string.
     *
     * @input array
     */
    public function actionEdit($id)
    {
        $model = Phones::find()->where(['id' => $id])->one();

        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('edit',
            ['model' => $model]
        );

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}
