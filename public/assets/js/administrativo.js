var agence = function () {
    
    $('#btRelatorio').on('click', function(){
        $('#tabla').removeClass('hide');
        var arrayConsultores = $("#consultores").val();
        var start = $("#start").val();
        var end = $("#end").val();
        $(".select2-selection__rendered").find("li").each(function(index){
            if($(this).text() != ""){
                var valorAnterior = index;
                arrayConsultores[valorAnterior]; 
            }
        });
        $.ajax({
            dataType: "json",
            url: $urlBase + "/getRelatorio",
            data: {consultores: arrayConsultores, start : start, end:end},
            success: function(data) {
                
                var consultores = '';
                //$('#tabla').empty();
                console.log(data['consultor'].length, data['consultor']);

                for(var j = 0; j < data['consultor'].length; j++) {
                    console.log(j, data['consultor'][j])
                }
                for(var i = 0; i < data.length; i++) {
                    var lucro = (data[i].receita -(data[i].custo_fixo + data[i].comissao))
                    
                    consultores =   '<table class="table table-striped table-bordered table-hover order-column active" id="dtTable" width="100%" bgcolor="#efefef" >' +
                                    '<thead>' +
                                    '<tr><td colspan="5">'+data[i].no_usuario+'</td></tr>' +
                                    '<tr>' +
                                    '<th>Período</th>' +
                                    '<th>Receita Líquida</th>' +
                                    '<th>Custo Fixo</th>' +
                                    '<th>Comissao</th>' +
                                    '<th>Lucro</th>' +
                                    '</tr>' +
                                    '</thead>' +
                                    '<tbody>' +
                                    '<tr>' +
                                    '<td>'+data[i].period+'</td>' +
                                    '<td>'+parseFloat(data[i].receita).toFixed(2)+'</td>' +
                                    '<td>'+parseFloat(data[i].custo_fixo).toFixed(2)+'</td>' +
                                    '<td>'+parseFloat(data[i].comissao).toFixed(2)+'</td>' +
                                    '<td>'+parseFloat(lucro).toFixed(2)+'</td>' +
                                    '</tr>' +
                                    '</tbody>' ;
                    consultores +=  '</table>' ;
                   
                    $('#tabla').append(consultores);
                }
            } //fin de success
        });
        
 
        $('#dtTable').removeClass('hide');
        $('#grafica').addClass('hide');
        $('#pizza').addClass('hide');

   
    });

    $('#btGrafica').on('click', function(){
        var arrayConsultores = $("#consultores").val();
        var start = $("#start").val();
        var end = $("#end").val();
        graficonsultor(arrayConsultores,start,end);
        $('#dtTable').addClass('hide');
        $('#pizza').addClass('hide');
        $('#chartConsultor').removeClass('hide');

    });

    $('#btpizza').on('click', function(){
        var arrayConsultores = $("#consultores").val();
        var start = $("#start").val();
        var end = $("#end").val();
        graficonsultorcircular(arrayConsultores,start,end)
        $('#dtTable').addClass('hide');
        $('#chartConsultor').addClass('hide');
        $('#pizza').removeClass('hide');

    });

    /*Gráfica*/
    var graficonsultor = function(arrayConsultores,start,end){
        $.ajax({
            dataType: "json",
            url: $urlBase + "/getRelatorio",
            data: {consultores: arrayConsultores, start : start, end:end},
            success: function(data) {

        console.log(data);
        am4core.ready(function() {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Create chart instance
        var chart = am4core.create("chartConsultor", am4charts.XYChart3D);
    
        $.each(data, function( index, value ) {
            chart.data.push({
                "consultor": value.no_usuario,
                "receita": value.receita
            });
        });

        // Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "consultor";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 60;
categoryAxis.tooltip.disabled = true;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 50;
valueAxis.min = 0;
valueAxis.cursorTooltipEnabled = false;

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "receita";
series.dataFields.categoryX = "consultor";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

// on hover, make corner radiuses bigger
var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
})


var paretoValueAxis = chart.yAxes.push(new am4charts.ValueAxis());
paretoValueAxis.renderer.opposite = true;
paretoValueAxis.min = 0;
paretoValueAxis.max = 100;
paretoValueAxis.strictMinMax = true;
paretoValueAxis.renderer.grid.template.disabled = true;
paretoValueAxis.numberFormatter = new am4core.NumberFormatter();
paretoValueAxis.numberFormatter.numberFormat = "#'%'"
paretoValueAxis.cursorTooltipEnabled = false;

var paretoSeries = chart.series.push(new am4charts.LineSeries())
paretoSeries.dataFields.valueY = "receita";
paretoSeries.dataFields.categoryX = "consultor";
paretoSeries.yAxis = paretoValueAxis;
paretoSeries.tooltipText = "pareto: {valueY.formatNumber('#.0')}%[/]";
paretoSeries.bullets.push(new am4charts.CircleBullet());
paretoSeries.strokeWidth = 2;
paretoSeries.stroke = new am4core.InterfaceColorSet().getFor("alternativeBackground");
paretoSeries.strokeOpacity = 0.5;

// Cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "panX";
    
   /*      // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "consultor";
            categoryAxis.renderer.labels.template.rotation = 300;
            categoryAxis.renderer.labels.template.hideOversized = false;
            categoryAxis.renderer.minGridDistance = 20;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.tooltip.label.rotation = 270;
            categoryAxis.tooltip.label.horizontalCenter = "right";
            categoryAxis.tooltip.label.verticalCenter = "middle";
    
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.title.text = "RECEITA LIQUIDA";
            valueAxis.title.fontWeight = "bold";
    
        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries3D());
            series.dataFields.valueY = "receita";
            series.dataFields.categoryX = "consultor";
            series.name = "receita";
            series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            series.columns.template.fillOpacity = .8;
    
        var columnTemplate = series.columns.template;
            columnTemplate.strokeWidth = 2;
            columnTemplate.strokeOpacity = 1;
            columnTemplate.stroke = am4core.color("#FFFFFF");
    
            columnTemplate.adapter.add("fill", function(fill, target) {
            return chart.colors.getIndex(target.dataItem.index);
            })
    
            columnTemplate.adapter.add("stroke", function(stroke, target) {
            return chart.colors.getIndex(target.dataItem.index);
            })
    
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.lineX.strokeOpacity = 0;
            chart.cursor.lineY.strokeOpacity = 0; */
    
    
        }); // end am4core.ready()
    
        } 
    });
}
    /*Fin de Gráfica*/
    var graficonsultorcircular = function(arrayConsultores,start,end){
        $.ajax({
            dataType: "json",
            url: $urlBase + "/getGraficoConsultores",
            data: {consultores: arrayConsultores, start : start, end:end},
            success: function(data) {

                
            am4core.ready(function() {
                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Create chart instance
                var chart = am4core.create("pizza", am4charts.PieChart);
    
                $.each(data, function( index, value ) {
                    
                    chart.data.push({
                        "consultor": value.no_usuario,
                        "receita": value.receita
                    });
                });
                
                    // Add and configure Series
                var pieSeries = chart.series.push(new am4charts.PieSeries());
                pieSeries.dataFields.value = "receita";
                pieSeries.dataFields.category = "consultor";
                pieSeries.innerRadius = am4core.percent(50);
                pieSeries.ticks.template.disabled = true;
                pieSeries.labels.template.disabled = true;
    
                var rgm = new am4core.RadialGradientModifier();
                rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
                pieSeries.slices.template.fillModifier = rgm;
                pieSeries.slices.template.strokeModifier = rgm;
                pieSeries.slices.template.strokeOpacity = 0.4;
                pieSeries.slices.template.strokeWidth = 0;
    
                chart.legend = new am4charts.Legend();
                chart.legend.position = "right";
    
                
                }); // end am4core.ready()
            }
        })
    }



    return {

        init: function () {
            $.LoadingOverlay("show");
            var d1 = fillComboBox($urlBase + '/getConsultores', $("#consultores"));
        
        
            $.when(d1).then(function (data, textStatus, jqXHR) {
                $.LoadingOverlay("hide");
            });
            

        }
    };
}();

jQuery(document).ready(function() {

    agence.init();



    $('#desde, #hasta').datepicker({
        opens: 'center',
        autoclose: true,
        format: "yyyy-mm-dd",
        startView: 1,
        minViewMode: 1
    });
});
                