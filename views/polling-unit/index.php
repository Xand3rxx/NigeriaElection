<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\PollingUnit;
?>

<div class="container-fluid">
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($polling, 'polling_unit_name') 
            ->dropdownList(PollingUnit::find()->limit(102)
            ->select(['polling_unit_name', 'uniqueid'])
            ->indexBy('uniqueid')
            ->column()
            , ['prompt'=> 'Select Polling Unit']
            );
        ?>
<?php ActiveForm::end(); ?>

<div class="card-header card-header-primary">
    <h3 class="card-title">Poling Unit Information</h3>
</div><br>
<div class="row">
<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
        <div class="card-header  card-header-icon">
            <p style="color: #fff" class="card-category card-header-success">Polling Unit ID</p>
            <h3 class="card-title" id="pui"></h3>
        </div>
        <div class="card-footer">
            <div class="stats">
            <i class="material-icons"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-icon">
                  <p style="color: #fff" class="card-category card-header-danger">Polling Unit Number</p>
                  <h3 class="card-title" id="pun"></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons"></i>
                  </div>
                </div>
              </div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
    <div class="card-header  card-header-icon">
        <p style="color: #fff" class="card-category card-header-warning">Ward</p>
        <h3 class="card-title" id="ward"></h3>
    </div>
    <div class="card-footer">
        <div class="stats">
        <i class="material-icons"></i>
        </div>
    </div>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header  card-header-icon">
                  <p style="color: #fff" class="card-category card-header-info">L.G.A</p>
                  <h3 class="card-title" id="lga"></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons"></i>
                  </div>
                </div>
              </div>
            </div>
</div>

</div>
<div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Description</span>
            
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                      <table class="table">
                        <tbody>
                          <tr>
                          <td style="font-size: 18px" id="desc"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

<br>
<div class="card-header card-header-primary">
    <h3 class="card-title">Party Results</h3>
</div>

<div class="row" id="results"></div>
</div>
     

<?php
 $script = <<< JS
$(document).ready(function(){
    $('#pollingunit-polling_unit_name').on('change', function(){
        //Polling Unit Information
        let uid = $(this).val();
        $('#results').empty();
        $.get('index.php?r=site/details', {id : uid}, function(data){
        var data = $.parseJSON(data);
            for(i=0; i<data.length;i++){
                $('#pun').text(data[i].polling_unit_number);
                $('#pui').text(data[i].polling_unit_id);
                if($.trim(data[i].polling_unit_description).length > 0){
                    $('#desc').text(data[i].polling_unit_description); 
                }
                else{
                    $('#desc').text("No description found");
                }
                
                let ward = data[i].ward_id;
                let lga = data[i].lga_id;

                $.get('index.php?r=site/wards', {id : ward}, function(data){
                    var data = $.parseJSON(data);
                    $('#ward').text(data.ward_name);
                });

                $.get('index.php?r=site/lga', {id : lga}, function(data){
                    var data = $.parseJSON(data);
                    if($.trim(data.lga_name).length > 0){
                        $('#lga').text(data.lga_name); 
                    }
                    else{
                        $('#lga').text("No L.G.A found");
                    }
                });
            }
        });

        //Get polling results for all parties via Polling Unit selected
        $.get('index.php?r=site/results', {id : uid}, function(data){
            var data = $.parseJSON(data);
            var display = ''
            for(i=0; i<data.length;i++){
                if($.trim(data).length > 0){
                    display = '<div  class="col-lg-3 col-md-6 col-sm-6"><div class="card card-stats"><div class="card-header  card-header-icon"><p style="color: #fff" class="card-category card-header-danger">'+data[i].party_abbreviation+'</p><h3 class="card-title">'+data[i].party_score+'</h3></div><div class="card-footer"><div class="stats"><i class="material-icons"></i></div></div></div></div></div>';
                $('#results').append(display);
                }
                else{
                    $('#results').text("No Party Polling Results for this Polling Unit");
                }
            }
            
        });
    });

});

JS;
$this->registerJs($script); 

?>