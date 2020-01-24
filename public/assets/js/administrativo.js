var agence = function () {

    
    
    $('#btGrafica').on('click', function(){
        var arrayConsultores = $("#consultores").val();
        var start = $("#start").val();
        var end = $("#end").val();
        graficonsultor(arrayConsultores,start,end);
        $('#dtTable').empty();//addClass('hide');
        $('#pizza').addClass('hide');
        $('#chartConsultor').removeClass('hide');

    });

    $('#btpizza').on('click', function(){

        var arrayConsultores = $("#consultores").val();
        var start = $("#start").val();
        var end = $("#end").val();
        graficonsultorcircular(arrayConsultores,start,end)
        $('#dtTable').empty();//addClass('hide');
        $('#chartConsultor').addClass('hide');
        $('#pizza').removeClass('hide');

    });

    $("#selectAll").click(function(){
        $("#consultores > option").prop("selected","selected");// Select All Options
        $("#consultores").trigger("change");// Trigger change to select 2
    });

  
    var graficonsultor = function(arrayConsultores,start,end){
        var datos = [];
        $.ajax({
            dataType: "json",
            url: $urlBase + "/getGraficoConsultores",
            data: {consultores: arrayConsultores, start : start, end:end},
            success: function(data) {
                $.each(data, function( index, value ) {
                    if(value.type == 'spline'){
                        var  marker = {
                                lineWidth: 2,
                                lineColor: Highcharts.getOptions().colors[3],
                                fillColor: 'white'
                             }
                        
                    }else{
                        var  marker = {}
                    }

                    datos.push({
                        "type": value.type,
                        "name": value.name,
                        "data": $.each(value.datos, function(i,v){
                            return v;
                        }),
                        "marker": marker
                    });
                }); 
               
                $('#chartConsultor').highcharts({
                        title: {
                            text: 'Grafico de Barras'
                        },
                        xAxis: {
                        categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', '', '',]
                        },
                          
                          series:  datos 
                     
                });
                
            } 
        });
    }

    /*Fin de Gráfica*/
    var graficonsultorcircular = function(arrayConsultores,start,end){
        $.ajax({
            dataType: "json",
            url: $urlBase + "/getPizzaConsultores",
            data: {consultores: arrayConsultores, start : start, end:end},
            success: function(data) {

            am4core.ready(function() {
                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Create chart instance
                var chart = am4core.create("pizza", am4charts.PieChart);
    
                $.each(data, function( index, value ) {
                    
                    chart.data.push({
                        "consultor": value.name,
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
                chart.legend.position = "bottom";
                chart.legend.scrollable = true;
                chart.legend.maxWidth = 300;
    
                
                }); 
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

    $('#desde').datepicker({
        opens: 'center',
        autoclose: true,
        format: "yyyy-mm-dd",
        startView: 1,
        minViewMode: 1
    }).datepicker("setDate", new Date('2000-01-02'));

    $('#hasta').datepicker({
        opens: 'center',
        autoclose: true,
        format: "yyyy-mm-dd",
        startView: 1,
        minViewMode: 1
    }).datepicker("setDate", new Date());
});
                