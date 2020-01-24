 //Plug in para filtrar y paginar en el server.
$.fn.dataTable.pipeline = function ( opts ) {
    // Configuration options
    var conf = $.extend( {
        pages: 5,     // number of pages to cache
        url: '',      // script url
        data: null,   // function or object with parameters to send to the server
                      // matching how `ajax.data` works in DataTables
        method: 'GET' // Ajax HTTP method
    }, opts );

    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;



    return function ( request, drawCallback, settings ) {
        var ajax          = false;
        var requestStart  = request.start;
        var drawStart     = request.start;
        var requestLength = request.length;
        var requestEnd    = requestStart + requestLength;

        if ( settings.clearCache ) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        }
        else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
            // outside cached data - need to make a request
            ajax = true;
        }
        else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                  JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                  JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
        ) {
            // properties changed (ordering, columns, searching)
            ajax = true;
        }


        // Store the request for checking next time around
        cacheLastRequest = $.extend( true, {}, request );

        if ( ajax ) {
            // Need data from the server
            if ( requestStart < cacheLower ) {
                requestStart = requestStart - (requestLength*(conf.pages-1));

                if ( requestStart < 0 ) {
                    requestStart = 0;
                }
            }

            cacheLower = requestStart;
            cacheUpper = requestStart + (requestLength * conf.pages);

            request.start = requestStart;
            request.length = requestLength*conf.pages;

            // Provide the same `data` options as DataTables.
            if ( $.isFunction ( conf.data ) ) {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data( request );
                if ( d ) {
                    $.extend( request, d );
                }
            }
            else if ( $.isPlainObject( conf.data ) ) {
                // As an object, the data given extends the default
                $.extend( request, conf.data );
            }

            request.search['hab'] = $('#dtF').val();

            settings.jqXHR = $.ajax( {
                "type":     conf.method,
                "url":      conf.url,
                "data":     request,
                "dataType": "json",
                "cache":    false,
                "success":  function ( json ) {
                    cacheLastJson = $.extend(true, {}, json);

                    if ( cacheLower != drawStart ) {
                        json.data.splice( 0, drawStart-cacheLower );
                    }
                    if ( requestLength >= -1 ) {
                        json.data.splice( requestLength, json.data.length );
                    }

                    drawCallback( json );
                }
            } );
        }
        else {
            json = $.extend( true, {}, cacheLastJson );
            json.draw = request.draw; // Update the echo for each response
            json.data.splice( 0, requestStart-cacheLower );
            json.data.splice( requestLength, json.data.length );

            drawCallback(json);
        }
    }
};

// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register('clearPipeline()', function () {
    return this.iterator('table', function (settings) {
        settings.clearCache = true;
    });
});

var languageDataTablet = {
    "aria": {
        "sortAscending": ": Activar para ordenar la columna ascendente",
        "sortDescending": ": Activar para ordenar la columna descendente"
    },
    "emptyTable": "No hay datos disponibles en la tabla",
    "info": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
    "infoEmpty": "Rigistros no encontrados",
    "infoFiltered": "(filtered1 de _MAX_ registros en total)",
    "lengthMenu": "_MENU_ Registros",
    "search": "Buscar:",
    "zeroRecords": "No se encontraron registros coincidentes",
    select: {
        rows: " %d filas seleccionadas"
    }
};

$.extend( true, $.fn.dataTable.defaults, {
    /*"searching": false,
    "ordering": false*/
} );

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    /*$.fn.fileinput.defaults = {
        language: 'en',
        showCaption: true,
        showPreview: true,
        showRemove: true,
        showUpload: false, // <------ just set this from true to false
        showCancel: true,
        showUploadedThumbs: true,
        // many more below
    };
    */
    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es requerido.",
        remote: "Please fix this field.",
        email: "Por favor, introduce una dirección de correo electrónico válida.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Por favor, introduzca el mismo valor de nuevo.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Por favor ingrese minimo {0} caracteres."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
        min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
    });


    $.fn.select2.defaults.set("theme", "bootstrap");

   /*  $('.select_2').select2({
        placeholder: 'Seleccione...',
        allowClear: true,
        width: 'resolve',
        minimumResultsForSearch: -1,
        dropdownCssClass : 'no-search',
        showSearchBox: true,
        //maximumSelectionLength: 2,
        language: 'es',
        /*initSelection: function(element, callback) {
        }
    }); */
    $('.select_2').select2({
        placeholder: 'Seleccione...',
        allowClear: true,
       // width: 'resolve',
        minimumResultsForSearch: 1,
        //dropdownCssClass : 'no-search',
        showSearchBox: true,
       // maximumSelectionLength: 2,
        language: 'es',
      /*   initSelection: function(element, callback) {
        } */
    });


    //////////////////////////////////////////////////////////
    //Select con imágenes para los perfiles (getComboPerfiles
    //////////////////////////////////////////////////////////
    $('.select_3').select2({
        placeholder: 'Seleccione...',
        allowClear: false,
        width: 'resolve',
        maximumInputLength: 15,
        dropdownCssClass : 'no-search',
        showSearchBox: true,
        language: 'es',
        templateResult: template,
        templateSelection: function (option) {
            if (option.id.length > 0 ) {
                return option.text; //+ "<i class='fa fa-dot-circle-o'></i>";
            } else {
                return option.text;
            }
        },
            escapeMarkup: function (m) {
                return m;
            }
    });

    function template (option) {
            console.log(option);
            if (!option.id) { return option.text; }
            var ob = '<img src="" height="42" width="42" />' + "  " + option.text;   // replace image source with option.img (available in JSON)
            return ob;
    };

    //////////////////////////////////////////////////

    /*$('.modal-toggle').click(function (e) {
        console.log("aaa");
        $('li > a[href="#tab1"]').tab("show");
    });*/


});

var fillComboBox = function(url, ele){

		return $.getJSON(url, function(data) {
			ele.empty();
            ele.append('<option></option>');
			for (var i=0; i<data.list.length; i++) {
                ele.append('<option value="' + data.list[i].val + '">' + data.list[i].text +'</option>'); //Agregado text2 para insertar la nomenclatura
            }

        }, "json")
};

var fillComboBox2 = function(url, ele){

        return $.getJSON(url, function(data) {
            ele.empty();
            ele.append('<option></option>');
            for (var i=0; i<data.list.length; i++) {
                ele.append('<option value="' + data.list[i].val + '">' + data.list[i].text + '  ' + data.list[i].text2 + '</option>');
            }

        }, "json")
};
var fillComboBox3 = function(url, ele){

        return $.getJSON(url, function(data) {
            ele.empty();
            ele.append('<option></option>');
            for (var i=0; i<data.list.length; i++) {
                ele.append('<option value="' + data.list[i].val + '">' + data.list[i].text + '</option>');
            }

        }, "json")
};

var fillComboBox4 = function(url, ele){

        return $.getJSON(url, function(data) {
            ele.empty();
            ele.append('<option></option>');
            for (var i=0; i<data.list.length; i++) {
                ele.append('<option value="' + data.list[i].val + '">' + data.list[i].text + '</option>');
            }

        }, "json")
};

var fillComboBox5 = function(url, ele){

        return $.getJSON(url, function(data) {
            ele.empty();
            ele.append('<option></option>');
            for (var i=0; i<data.list.length; i++) {
                ele.append('<option value="' + data.list[i].val + '">' + data.list[i].text + '</option>');
            }

        }, "json")
};


/*
var guardarForm = function(url, data, callback){
	///waitingDialog.show('Por favor espere...', { dialogSize: 'sm' });
    $.LoadingOverlay("show");
	$.ajax({
        url: url,
        contentType: "application/json",
        type: "POST",
        dataType: "json",
        cache: false,
        data: data,
    }).done(function (datos, textStatus, jqXHR) {
        callback(datos, textStatus, jqXHR);
        $.LoadingOverlay("hide");
    }).fail(function(jqXHR, textStatus, errorThrown) {
        $.LoadingOverlay("hide");
	});
    $.LoadingOverlay("hide");
	//waitingDialog.hide();
};
*/

var PopulateForm = function(frm, data){
	$.each(data, function(key, value){
	    var $ctrl = $('[name='+key+']', frm);
	    if(value != null){
	    	//value = value.trim();
        }
        //console.log(value, $ctrl.attr("id"));
	    switch($ctrl.attr("type"))
	    {
            case "file":
	        	//$ctrl.val(value);
	        break;
	        case "text" :
	        case "hidden":
	        case "email":
	        case "tel":
	        	$ctrl.val(value);
	        break;
	        case "date":
	        	var d = new Date(value);
	        	$ctrl.val(d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate());
	        break;
	        case "radio" : case "checkbox":
	        	$ctrl.each(function(){
	           		if($(this).attr('value') == value) {  $(this).attr("checked",value); }
	       		});
	        break;
            case "select":

                $('#' + $ctrl.attr("id")).val(value).trigger('change');

	        break;
	        default:
	        	$ctrl.val(value);
	    }
    });

};

var formReset = function(form){

    $(form).find('.has-error').css('border-color', '').removeClass('has-error');
    $(form).validate().resetForm();

    $(form).find(':input').each(function() {
        var ele = this;
        var dv = $(ele).attr('data-default');
        if(dv == undefined){
            dv = '';
        }else{

        }
        switch(ele.type)
	    {
            case "file":
	        	//$ctrl.val(value);
	        break;
	        case "text":
	        case "hidden":
	        case "email":
            case "tel":
            case "textarea":
                $('#' + ele.id).val(dv);
	        break;
	        case "date":
	        	/*var d = new Date(value);
	        	$ctrl.val(d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate());*/
	        break;
	        case "radio" : case "checkbox":
	        	/*$ctrl.each(function(){
	           		if($(this).attr('value') == value) {  $(this).attr("checked",value); }
	       		});*/
	        break;
            case "select-one":
                $('#' + ele.id).val(dv).trigger('change');
	        break;
           // default:
              //  $('#' + ele.id).val(value);
	    }
    });
}

var formReset2 = function(form){

    $('.select_2').val("").trigger('change');

    form[0].reset();
    form.find('.has-error').css('border-color', '').removeClass('has-error');
    form.validate().resetForm();



    //$('li > a[href="#tab1"]').tab("show");
}



var showAlert = function(title, message){
    bootbox.dialog({
        title: title,
        message: message,
        buttons: {
            yes: {
                label: "Aceptar",
                className: "green",
                callback: function() {

                }
            }
        }
    });
}


