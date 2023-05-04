<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
//use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\ForbiddenHttpException;
use common\components\rbac\UserGroupRule;
use yii2mod\rbac\filters\AccessControl;
use p2m\assets\P2CoreAsset;

/**
 * Site controller
 */
class SiteController extends Controller
{
    //public $layout = "main-ins";
    public $layout = "main-x";
    //public $layout = "main-my";
    /*public $layout = "main-light-bootstrap";*/
    /*public $layout = "main-pmade-sb-admin";*/
    //public $layout = "main";

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            // For access per rbac yii\rbac\PhpManager
             'access' => [
                'class' => AccessControl::className(),
                /*'denyCallback' => function ($rule, $action) {
                     throw new \Exception('You are not allowed to access this page');
                },*/
              //'only' => ['login', 'logout', 'signup', 'index', 'error', 'special-callback'],
                'rules' => [
                    /*[
                        'actions' => ['special-callback'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return date('d-m') === '31-10';
                        }
                    ],*/
                    [
                        'actions' => ['login', 'logout', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index','update'],
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

    /*public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if ( !\Yii::$app->user->can($action->id)) {
                throw new ForbiddenHttpException('Access denied');
            }
            return true;
        } else {
            return false;
        }
    }*/

    /**
     * @inheritdoc
     */
    public function actions()
    {
        //P2CoreAsset::register($this);

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'page' => [
                'class' => 'yii\web\ViewAction',
            ],
        ];
    }

    // Match callback called! This page can be accessed only each October 31st
    public function actionSpecialCallback()
    {
        return $this->render('happy-halloween');
    }

    public function actionUpdate(   )
    {
        if (!\Yii::$app->user->can('updateOwnProfile', ['profileId' => \Yii::$app->user->id])) {
            throw new ForbiddenHttpException('Access denied');
        }
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //$roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

        if ( !\Yii::$app->user->can('index')) {
            throw new ForbiddenHttpException('Access denied');
        }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
