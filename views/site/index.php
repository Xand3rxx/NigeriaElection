<?php

/* @var $this yii\web\View */

$this->title = 'Nigerian Election';

?>
<?php
$script = <<< JS
addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

$(window).load(function () {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
JS;
$this->registerJs($script); 

?>
<div class="site-index">
    <!--// top-bar -->
    <div class="container-fluid">
                <div class="row">
                    <!-- Stats -->
                    <div class="outer-w3-agile col-xl">
                        <div class="stat-grid p-3 d-flex align-items-center justify-content-between bg-primary">
                            <div class="s-l">
                                <h5>Polling Units</h5>
                                <p class="paragraph-agileits-w3layouts text-white">Total Polling Units across the country</p>
                            </div>
                            <div class="s-r">
                                <h6><?= $polling; ?>
                                    <i class="far fa-edit"></i>
                                </h6>
                            </div>
                        </div>
                        <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-success">
                            <div class="s-l">
                                <h5>Wards</h5>
                                <p class="paragraph-agileits-w3layouts text-white">Total Wards in all L.G.A's of Delta State</p>
                            </div>
                            <div class="s-r">
                                <h6><?= $ward; ?>
                                    <i class="far fa-smile"></i>
                                </h6>
                            </div>
                        </div>
                        <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-danger">
                            <div class="s-l">
                                <h5>L.G.A</h5>
                                <p class="paragraph-agileits-w3layouts text-white">Total L.G.A in Delta State of Nigeria</p>
                            </div>
                            <div class="s-r">
                                <h6><?= $lga; ?>
                                    <i class="fas fa-tasks"></i>
                                </h6>
                            </div>
                        </div>
                        <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between bg-warning">
                            <div class="s-l">
                                <h5>States</h5>
                                <p class="paragraph-agileits-w3layouts text-white">Total number of states</p>
                            </div>
                            <div class="s-r">
                                <h6><?= $states; ?>
                                    <i class="fas fa-users"></i>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <!--// Stats -->
                    <!-- Pie-chart -->
                    <div class="outer-w3-agile col-xl ml-xl-3 mt-xl-0 mt-3">
                        <h4 class="tittle-w3-agileits mb-4">Pie Chart</h4>
                        <div id="chartdiv"></div>
                    </div>
                    <!--// Pie-chart -->
                </div>
            </div>

</div>
<?php
 $script = <<< JS
$(document).ready(function(){
    $(".dropdown").hover(
        function () {
            $('.dropdown-menu', this).stop(true, true).slideDown("fast");
            $(this).toggleClass('open');
        },
        function () {
            $('.dropdown-menu', this).stop(true, true).slideUp("fast");
            $(this).toggleClass('open');
        }
    );

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    //<![CDATA[
        $(function () {
            $('.calender').pignoseCalender({
                select: function (date, obj) {
                    obj.calender.parent().next().show().text('You selected ' +
                        (date[0] === null ? 'null' : date[0].format('YYYY-MM-DD')) +
                        '.');
                }
            });

            $('.multi-select-calender').pignoseCalender({
                multiple: true,
                select: function (date, obj) {
                    obj.calender.parent().next().show().text('You selected ' +
                        (date[0] === null ? 'null' : date[0].format('YYYY-MM-DD')) +
                        '~' +
                        (date[1] === null ? 'null' : date[1].format('YYYY-MM-DD')) +
                        '.');
                }
            });
        });
        //]]>


});

JS;
$this->registerJs($script); 

?>

<!-- pie-chart -->
<?php
$script = <<< JS
        var chart;
        var legend;

        var chartData = [{
                country: "Polling Units",
                value: 272
            },
            {
                country: "Wards",
                value: 263
            },
            {
                country: "L.G.A",
                value: 25
            },
            {
                country: "States",
                value: 37
            },
            
        ];

        AmCharts.ready(function () {
            // PIE CHART
            chart = new AmCharts.AmPieChart();
            chart.dataProvider = chartData;
            chart.titleField = "country";
            chart.valueField = "value";
            chart.outlineColor = "";
            chart.outlineAlpha = 0.8;
            chart.outlineThickness = 2;
            // this makes the chart 3D
            chart.depth3D = 20;
            chart.angle = 30;

            // WRITE
            chart.write("chartdiv");
        });
        
JS;
$this->registerJs($script); 

?>
<!--// pie-chart -->