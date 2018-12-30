<?php

namespace app\controllers;

use Yii;
use app\models\Lga;
use app\models\PollingUnit;
use app\models\AnnouncedPuResults;


class PollingUnitController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $polling = new PollingUnit();
        return $this->render('index',
         [
             'polling'=>$polling,    
         ]);
    
    }
    public function actionLga()
    {
        $lga = new Lga();
        //$polling = PollingUnit::find()->orderBy('uniqueid');
        return $this->render('lga',
         [
             'lga'=>$lga,    
         ]);
    
    }

    public function actionRecord()
    {
       
        $addPoll = new AnnouncedPuResults();

        if ($addPoll->load(Yii::$app->request->post())) {
            // Validate textfield
            if ($addPoll->validate()) {
                // Save record to announced_pu_results
                $addPoll->save();
                //Send message flash
                $success = '<strong>Success! </strong>Party result has been added';
                Yii::$app->getSession()->setFlash('success', $success);
                return $this->redirect('index.php');
            }
        }   

        return $this->render('record', ['addPoll'=>$addPoll]);
    
    }

}
