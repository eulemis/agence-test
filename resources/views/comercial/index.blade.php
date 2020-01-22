@extends('layouts.app') 
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Comercial</span>
                    <span class="caption-helper">Estamos en Desarrollo</span>
                </div>

                <div class="actions">
                  
                    <button class="btn green btn-outline btn-circle modal-toggle" data-target="#mCRUD" data-toggle="modal" id="btnAgregar"><i class="fa fa-plus"></i> Nuevo  </button>

                    <div class="btn-group">
                        <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-share"></i> 
                            <span class="hidden-xs">Herramientas</span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right" id="table_tools">

                            <li class="hidden">
                                <a href="javascript:;" data-action="0" class="tool-action">
                            <i class="icon-printer"></i> Print</a>
                            </li>
                            <li class="hidden">
                                <a href="javascript:;" data-action="1" class="tool-action">
                            <i class="icon-check"></i> Copy</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="2" class="tool-action">
                            <i class="icon-doc"></i> PDF</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="3" class="tool-action">
                            <i class="icon-paper-clip"></i> Excel</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="4" class="tool-action">
                            <i class="icon-cloud-upload"></i> CSV</a>
                            </li>
                            <!--<li>
                                <a href="javascript:;" data-action="5" class="tool-action">
                                    <i class="icon-cloud-upload"></i> Campos</a>
                            </li>-->
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;" data-action="6" class="tool-action">
                                <i class="icon-refresh"></i> Reload</a>
                            </li>

                        </ul>
                    </div>
                </div>


            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="dtTable" width="100%">
                    <thead>
    
                    </thead>

                </table>
            </div>
        </div>

    </div>
</div>

@endsection

