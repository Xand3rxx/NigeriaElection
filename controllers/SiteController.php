<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PollingUnit;
use app\models\Ward;
use app\models\Lga;
use app\models\AnnouncedPuResults;
use app\models\States;
use yii\helpers\Json;


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
        // $this->registerAssetBundle(yii\web\JqueryAsset::className(), VIEW::POS_HEAD);
        // Yii::$app->clientScript->registerScriptFile(Yii::$app->request->baseUrl.'/web/js/jquery-2.2.3.min.js', CClientSCript::POS_HEAD);
        $polling = PollingUnit::find()->orderBy('uniqueid')->count();
        $ward = Ward::find()->orderBy('uniqueid')->count();
        $lga = Lga::find()->orderBy('uniqueid')->count();
        $states = States::find()->orderBy('stateid')->count();

        //echo $polling;
        return $this->render('index',
         [
             'polling'=>$polling,
             'ward'=>$ward,
             'lga'=>$lga,
             'states'=>$states,                

         ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        //Custom layout for login
        $this->layout = 'loginLayout';
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

    //Get details for a selected Polling Unit
    public function actionDetails($id)
    {
        $polling = PollingUnit::find()
        ->where(['uniqueid'=>$id])
        ->all();
        echo Json::encode($polling);
    }

    //Get Ward Name for a selected Polling Unit
    public function actionWards($id)
    {
        $ward = Ward::find()
        ->where(['ward_id'=>$id])
        ->one();
        echo Json::encode($ward);
    }

    //Get LGA Name for a selected Polling Unit
    public function actionLga($id)
    {
        $lga = Lga::find()
        ->where(['lga_id'=>$id])
        ->one();
        echo Json::encode($lga);
    }

    //Get polling results for all parties via Polling Unit selected
    public function actionResults($id)
    {
        $res = AnnouncedPuResults::find()
        ->where(['polling_unit_uniqueid'=>$id])
        ->all();
        echo Json::encode($res);
    }

    //Get polling results for all parties via LGA selected
    public function actionLgaResults($id)
    {
        $data = PollingUnit::find()
        ->where(['lga_id'=>$id])
        ->all();
        return Json::encode($data);
    }

    public function actionPdp($id)
    {
        $res1 = AnnouncedPuResults::find()
        ->where(['polling_unit_uniqueid'=>$id])
        ->andwhere(['party_abbreviation'=>'PDP'])
        ->all();
        return Json::encode($res1);
    }

    public function actionAcn($id)
    {
        $res2 = AnnouncedPuResults::find()
        ->where(['polling_unit_uniqueid'=>$id])
        ->andwhere(['party_abbreviation'=>'ACN'])
        ->all();
        echo Json::encode($res2);
    }

    public function actionDpp($id)
    {
        $res3 = AnnouncedPuResults::find()
        ->where(['polling_unit_uniqueid'=>$id])
        ->andwhere(['party_abbreviation'=>'DPP'])
        ->all();
        echo Json::encode($res3);
    }

    public function actionPpa($id)
    {
        $res4 = AnnouncedPuResults::find()
        ->where(['polling_unit_uniqueid'=>$id])
        ->andwhere(['party_abbreviation'=>'PPA'])
        ->all();
        echo Json::encode($res4);
    }

    public function actionCdc($id)
    {
        $res5 = AnnouncedPuResults::find()
        ->where(['polling_unit_uniqueid'=>$id])
        ->andwhere(['party_abbreviation'=>'CDC'])
        ->all();
        echo Json::encode($res5);
    }

    public function actionJp($id)
    {
        $res6 = AnnouncedPuResults::find()
        ->where(['polling_unit_uniqueid'=>$id])
        ->andwhere(['party_abbreviation'=>'JP'])
        ->all();
        echo Json::encode($res6);
    }

    public function actionAnpp($id)
    {
        $res7 = AnnouncedPuResults::find()
        ->where(['polling_unit_uniqueid'=>$id])
        ->andwhere(['party_abbreviation'=>'ANPP'])
        ->all();
        echo Json::encode($res7);
    }

    public function actionLabo($id)
    {
        $res8 = AnnouncedPuResults::find()
        ->where(['polling_unit_uniqueid'=>$id])
        ->andwhere(['party_abbreviation'=>'LABO'])
        ->all();
        echo Json::encode($res8);
    }

    public function actionCpp($id)
    {
        $res9 = AnnouncedPuResults::find()
        ->where(['polling_unit_uniqueid'=>$id])
        ->andwhere(['party_abbreviation'=>'CPP'])
        ->all();
        echo Json::encode($res9);
    }
    
}
