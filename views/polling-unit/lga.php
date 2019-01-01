<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Lga;
?>

<!--Start Container Fluid-->
<div class="container-fluid">
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($lga, 'lga_name') 
            ->dropdownList(Lga::find()
            ->select(['lga_name', 'lga_id'])
            ->indexBy('lga_id')
            ->column()
            , ['prompt'=> 'Select L.G.A']
            );
        ?>
<?php ActiveForm::end(); ?>

<!--Start Row-->
<div class="row">
</div>
<!--End Row-->

 
<div class="card">
        <div class="card-header card-header-tabs card-header-primary">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <span class="nav-tabs-title">TOTAL PARTY RESULTS</span>
                </div>
            </div>
        </div>

        <div class="card-body">
        <div class="row"> 
        <div  class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header  card-header-icon">
                    <p style="color: #fff" class="card-category card-header-danger">PDP</p><h3 class="card-title" id="pdp"></h3>
                </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons"></i>
                        </div>
                    </div>
            </div>
         </div>
                            

        <div  class="col-lg-3 col-md-6 col-sm-6"><div class="card card-stats"><div class="card-header  card-header-icon"><p style="color: #fff" class="card-category card-header-info">DPP</p><h3 class="card-title" id="dpp"></h3></div><div class="card-footer"><div class="stats"><i class="material-icons"></i></div></div></div></div>
        <div  class="col-lg-3 col-md-6 col-sm-6"><div class="card card-stats"><div class="card-header  card-header-icon"><p style="color: #fff" class="card-category card-header-primary">ACN</p><h3 class="card-title" id="acn"></h3></div><div class="card-footer"><div class="stats"><i class="material-icons"></i></div></div></div></div>

    <div  class="col-lg-3 col-md-6 col-sm-6"><div class="card card-stats"><div class="card-header  card-header-icon"><p style="color: #fff" class="card-category card-header-warning">PPA</p><h3 class="card-title" id="ppa"></h3></div><div class="card-footer"><div class="stats"><i class="material-icons"></i></div></div></div></div>

    <div  class="col-lg-3 col-md-6 col-sm-6"><div class="card card-stats"><div class="card-header  card-header-icon"><p style="color: #fff" class="card-category card-header-success">CDC</p><h3 class="card-title" id="cdc"></h3></div><div class="card-footer"><div class="stats"><i class="material-icons"></i></div></div></div></div>

    <div  class="col-lg-3 col-md-6 col-sm-6"><div class="card card-stats"><div class="card-header  card-header-icon"><p style="color: #fff" class="card-category card-header-danger">JP</p><h3 class="card-title" id="jp"></h3></div><div class="card-footer"><div class="stats"><i class="material-icons"></i></div></div></div></div>

    <div  class="col-lg-3 col-md-6 col-sm-6"><div class="card card-stats"><div class="card-header  card-header-icon"><p style="color: #fff" class="card-category card-header-info">ANPP</p><h3 class="card-title" id="anpp"></h3></div><div class="card-footer"><div class="stats"><i class="material-icons"></i></div></div></div></div>

    <div  class="col-lg-3 col-md-6 col-sm-6"><div class="card card-stats"><div class="card-header  card-header-icon"><p style="color: #fff" class="card-category card-header-primary">LABO</p><h3 class="card-title" id="labo"></h3></div><div class="card-footer"><div class="stats"><i class="material-icons"></i></div></div></div></div>

    <div  class="col-lg-3 col-md-6 col-sm-6"><div class="card card-stats"><div class="card-header  card-header-icon"><p style="color: #fff" class="card-category card-header-warning">CPP</p><h3 class="card-title" id="cpp"></h3></div><div class="card-footer"><div class="stats"><i class="material-icons"></i></div></div></div></div>
        
    
</div>
        </div>
</div>       




<!----------------------------------->
<br>
    <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <span class="nav-tabs-title">List of Polling Units</span>
                </div>
            </div>   
        </div>
            <div class="card-body">
                <div class="form-group">
                    <select id="ash" class="form-control">
                    </select>
                </div>
                <div class="row" id="results"></div>
            </div>
            <br>
    </div>
    


</div>
<!--End Container Fluid-->



<?php
 $script = <<< JS
$(document).ready(function(){
    $('#lga-lga_name').on('change', function(){
        let uid = $(this).val();
        var counter = 0;
        var cat = 0;
        var dpp = 0;
        var ppa = 0;
        var cdc =0;
        var jp = 0;
        var anpp = 0;
        var labo = 0;
        var cpp = 0;
        $('#ash, #results').empty();
        $.get('index.php?r=site/lga-results', {id : uid}, function(data){
            var data = $.parseJSON(data);
            var display = '';
            var dis = 'No Party Polling Units in this LGA';
            $('#ash').append('<option value="">Select Polling Unit</option>');
            for(i=0; i<data.length;i++){
                if($.trim(data).length > 0){
                    $('#ash').append('<option value="'+data[i].uniqueid+'">'+data[i].polling_unit_name+'</option>');
                }
                else{
                     $('#ash').append(dis);
                }

                //Try and get total for PDP
                let pdp = data[i].uniqueid;
                

$.get('index.php?r=site/pdp', {id : pdp}, function(data){
    var data = $.parseJSON(data);
   
    for(i=0; i<data.length;i++){
        counter += parseInt(data[i].party_score);
    }
    $('#pdp').text(counter);
    $.get('index.php?r=site/acn', {id : pdp}, function(data){
        var data = $.parseJSON(data);
        
        for(i=0; i<data.length;i++){
            cat += parseInt(data[i].party_score);
        }
        $('#acn').text(cat);

        $.get('index.php?r=site/dpp', {id : pdp}, function(data){
                    var data = $.parseJSON(data);
                    
                    for(i=0; i<data.length;i++){
                        dpp += parseInt(data[i].party_score);
                    }
                    $('#dpp').text(dpp);
                    $.get('index.php?r=site/ppa', {id : pdp}, function(data){
                        var data = $.parseJSON(data);
                        
                        for(i=0; i<data.length;i++){
                            ppa += parseInt(data[i].party_score);
                        }
                        $('#ppa').text(ppa);
                        $.get('index.php?r=site/cdc', {id : pdp}, function(data){
                        var data = $.parseJSON(data);
                        
                        for(i=0; i<data.length;i++){
                            cdc += parseInt(data[i].party_score);
                        }
                        $('#cdc').text(cdc);
                        $.get('index.php?r=site/jp', {id : pdp}, function(data){
                            var data = $.parseJSON(data);
                            
                            for(i=0; i<data.length;i++){
                                jp += parseInt(data[i].party_score);
                            }
                            $('#jp').text(jp);
                            $.get('index.php?r=site/anpp', {id : pdp}, function(data){
                                var data = $.parseJSON(data);
                                
                                for(i=0; i<data.length;i++){
                                    anpp += parseInt(data[i].party_score);
                                }
                                $('#anpp').text(anpp);
                                $.get('index.php?r=site/labo', {id : pdp}, function(data){
                                    var data = $.parseJSON(data);
                                    
                                    for(i=0; i<data.length;i++){
                                        labo += parseInt(data[i].party_score);
                                    }
                                    $('#labo').text(labo);

                                    $.get('index.php?r=site/cpp', {id : pdp}, function(data){
                                        var data = $.parseJSON(data);
                                        
                                        for(i=0; i<data.length;i++){
                                            cpp += parseInt(data[i].party_score);
                                        }
                                        $('#cpp').text(cpp);
                                    });
                                });
                            });
                        });
                    });
                });
                });
    });
});

                

                

                

                

               

                
                
                

                
            }
            
        });
    });

    //Get individual Parties total results via the polling unit selected
    $('#ash').on('change', function(){
        let pid = $(this).val();
        $('#results').empty();
        //Get polling results for all parties via Polling Unit selected
        $.get('index.php?r=site/results', {id : pid}, function(data){
            var data = $.parseJSON(data);
            var display = '';
            var counter = 0;
            for(i=0; i<data.length;i++){
                counter += parseInt(data[i].party_score);
                if($.trim(data).length > 0){
                    display = '<div  class="col-lg-3 col-md-6 col-sm-6"><div class="card card-stats"><div class="card-header  card-header-icon"><p style="color: #fff" class="card-category card-header-danger">'+data[i].party_abbreviation+'</p><h3 class="card-title">'+data[i].party_score+'</h3></div><div class="card-footer"><div class="stats"><i class="material-icons"></i></div></div></div></div></div>';
                $('#results').append(display);
                }
                else{
                    $('#results').text("No Party Polling Results for this Polling Unit");
                }
            }
            //$('#pdp').text(counter);
    });
});

});


JS;
$this->registerJs($script); 

?>