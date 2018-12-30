<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\PollingUnit;
?>

<div class="container-fluid">
<div class="card">
        <div class="card-header card-header-tabs card-header-primary">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <span class="nav-tabs-title">Add Party Results</span>
                </div>
            </div>   
        </div>
            <div class="card-body">
            <br>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($addPoll, 'polling_unit_uniqueid') 
        ->dropdownList(PollingUnit::find()
        ->select(['polling_unit_name', 'uniqueid'])
        ->indexBy('uniqueid')
        ->column()
        , ['prompt'=> 'Select Polling Unit']
        );
    ?>

<?= $form->field($addPoll, 'entered_by_user')->textInput(['maxlength' => true]) ?>
<?= $form->field($addPoll, 'user_ip_address')->textInput(['maxlength' => true]) ?>
<?= $form->field($addPoll, 'date_entered')->textInput(['maxlength' => true]) ?>
<?= $form->field($addPoll, 'party_abbreviation') 
    ->dropdownList([
        'prompt'=> 'Select Party',
        'ACN' => 'ACN',
        'ANPP' => 'ANPP',
        'CDC' => 'CDC',
        'CPP' => 'CPP',
        'DPP' => 'DPP',
        'JP' => 'JP',
        'LABO' => 'LABO',
        'PDP' => 'PDP',
        'PPA' => 'PPA',
    ]);
    
?>
<?= $form->field($addPoll, 'party_score')->textInput(['maxlength' => true]) ?>

<div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
    </div>
</div>


<?php
 $script = <<< JS
$(document).ready(function(){
    $('#announcedpuresults-user_ip_address').val('192.168.1.101');
    $('#announcedpuresults-date_entered').val('2018-04-26 16:20:49');
});
JS;
$this->registerJs($script); 

?>