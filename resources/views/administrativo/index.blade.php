@extends('layouts.app') 
@section('content')


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Administrativo</span>
                    <span class="caption-helper">Visualizar y administrar</span>
                </div>
            </div>
            <div class="portlet-body">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_couple2" data-toggle="tab">Por Consultor</a>
                    </li>
                    <li>
                        <a href="#tab_couple3" data-toggle="tab">Por Cliente</a>
                    </li>
                </ul>
            <div class="tab-content">
                <div class="tab-pane active " id="tab_couple2">   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-paper-plane h4-t"></i>
                                        <span class="caption-subject bold h4-t uppercase">Consulta por Consultor</span>
                                    </div>                            
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Periodo</h5>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Desde:</label>
                                                <div class='input-group date' id='desde'>
                                                <input type="text" id="start" name="start" class="form-control" readonly required >
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Hasta:</label>
                                                <div class='input-group date' id='hasta'>
                                                <input type="text" id="end" name="end" class="form-control" readonly required >
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Consultores</label>
                                                <select type="select" id="consultores" name="consultores" class="form-control select_2"  multiple="multiple" style="width: 100%" >
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div style="transform: translate(10px, 23px);" class="btn-group action">
                                                    <button type="button" class="btn btn-success dropdown-toggle boton accion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Action
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                        <li>
                                                            <a class="relatorio"  id="btRelatorio" >
                                                        <i style="color:#17C4BB" class="fa fa-money"></i>Relatorio</a>
                                                        </li>
                                                        <li>
                                                            <a  id="btGrafica" title="Gráfica de Barras">
                                                        <i style="color:#17C4BB" class="fa fa-bar-chart"></i>Gráfico</a>
                                                        </li>
                                                        <li>
                                                            <a  id="btpizza" title="Gráfica Circular">
                                                            <i style="color:#17C4BB" class="fa fa-pie-chart"></i>Pizza</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div><br><br><br><br><br>
                                <div class="portlet-body">
                                    <div id="pizza" style="width: 100%; height: 600px; background-color: #FFFFFF;" >
                                
                                    </div>
                                    <div id="tabla">
                                        
                                    </div>                                   
                                    <div id="chartConsultor" style="width: 100%; height: 600px; background-color: #FFFFFF;" >
                                    
                                    </div>                            
                                  
                                       
                                </div> 
                            </div>
                        </div>       
                    </div>
                </div>
                <div class="tab-pane fade " id="tab_couple3">   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-paper-plane h4-t"></i>
                                        <span class="caption-subject bold h4-t uppercase">Consulta por Clientes</span>
                                    </div>                            
                                </div>
                                <div class="portlet-body">
                                        <div class="row">
                                                <h4>Periodo</h4>
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Desde:</label>
                                                            <div class='input-group date' id='datetimepicker3'>
                                                            <input type="text" id="desde_cliente" name="date_cliente" class="form-control" readonly required >
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Hasta:</label>
                                                            <div class='input-group date' id='datetimepicker4'>
                                                            <input type="text" id="hasta_cliente" name="date_cliente" class="form-control" readonly required >
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Clientes</label>
                                                            <select type="text" id="" name="" class="form-control select_2" style="width:100%">
                                                        
                                                            
                                                                <option>Cliente 1</option>
                                                                <option>Cliente 2</option>
                                                                <option>Cliente 3</option>
                                                                <option>Cliente 4</option>
                                                            
                                                            </select>
                                                        </div>
                                                    </div> 
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                <div style="transform: translate(10px, 23px);" class="btn-group action">
                                                    <button type="button" class="btn btn-success dropdown-toggle boton accion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Action
                                                        <i class="fa fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right" role="menu">
                                                        <li>
                                                            <a class="relatorio"  id="btRelatorio" >
                                                        <i style="color:#17C4BB" class="fa fa-money"></i>Relatorio</a>
                                                        </li>
                                                        <li>
                                                            <a  id="btGrafica" title="Gráfica de Barras">
                                                        <i style="color:#17C4BB" class="fa fa-bar-chart"></i>Gráfico</a>
                                                        </li>
                                                        <li>
                                                            <a  id="btpizza" title="Gráfica Circular">
                                                            <i style="color:#17C4BB" class="fa fa-pie-chart"></i>Pizza</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> 
                                                        
                                        
                                        </div>
                            </div>
                        </div>       
                    </div>
                </div>

            </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="{{ asset('assets/js/administrativo.js') }}" type="text/javascript"></script>

@stop