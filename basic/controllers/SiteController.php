<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TasksSearch;
use app\models\Tasks;

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
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        return $this->render('tasks', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    
    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        if (empty($id) || is_array($id))
        {
            return $this->redirect(['site/index']);
        }
        $model = Tasks::findOne($id);
        if (!isset($model))
        {
            return $this->redirect(['site/index']);
        }
        return $this->render('task', [
            'model' => $model,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new Tasks();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            Yii::$app->session->setFlash('success', "Задача создана");
            return $this->redirect(['site/view', 'id' => $model->id]);
        }
        
        return $this->render('task-edit', [
            'model' => $model,
            'add' => true,
        ]);
    }
    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        if (empty($id) || is_array($id))
        {
            return $this->redirect(['site/index']);
        }
        $model = Tasks::findOne($id);
        if (!isset($model))
        {
            return $this->redirect(['site/index']);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            Yii::$app->session->setFlash('success', "Задача сохранена");
        }
        
        return $this->render('task-edit', [
            'model' => $model,
            'add' => false,
        ]);
    }
    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        if (empty($id) || is_array($id))
        {
            return $this->redirect(['site/index']);
        }
        $model = Tasks::findOne($id);
        if (isset($model))
        {
            $model->delete();
            Yii::$app->session->setFlash('success', "Задача удалена");
        }
        return $this->redirect(['site/index']);
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
