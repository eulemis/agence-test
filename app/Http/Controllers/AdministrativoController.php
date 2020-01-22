<?php

namespace App\Http\Controllers;

use App\Model\CaoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AdministrativoController extends Controller
{
    public function index()
    {
        return view('administrativo.index');
    }

    public function getConsultores(){
     
        $consultores = CaoUsuario::join('permissao_sistema', 'cao_usuario.co_usuario', '=', 'permissao_sistema.co_usuario')
                                ->whereIn('permissao_sistema.co_tipo_usuario', ['0','1','2'])
                                ->where('permissao_sistema.in_ativo','S')
                                ->where('permissao_sistema.co_sistema',1)
                                ->get()
                                ->map(function ($item) {
                                    return [
                                        "val"   => $item->co_usuario,
                                        "text"  => $item->no_usuario,
                                    ];
                                })->toArray();
   
                                return ['list' => $consultores];
    }

    public function getRelatorio(Request $request)
    {
        $users          =  $request->input('consultores');
        $start          =  $request->input('start');
        $end            =  $request->input('end');
        
        $arr_relatario['items'] = [];
        $rela = new Collection();

        $relatorio = \DB::table('cao_fatura as cf')
                        ->select('usu.no_usuario','usu.co_usuario','cs.brut_salario as custo_fixo', 'cf.valor', 
                        'cf.total_imp_inc','cf.comissao_cn',
                                DB::raw('MONTH(cf.data_emissao) as mes'),
                                DB::raw('DATE_FORMAT(cf.data_emissao,"%Y-%m") as period'),
                                DB::raw('SUM((cf.valor - ((cf.valor * cf.total_imp_inc)/100))) as receita'),
                                DB::raw('SUM(((cf.valor -((cf.valor * cf.total_imp_inc)/100))) * cf.comissao_cn)/100 as comissao')
                                )
                        ->join('cao_os as co','cf.co_os','=','co.co_os')
                        ->join('cao_usuario as usu','usu.co_usuario','=','co.co_usuario')
                        ->join('cao_salario as cs','co.co_usuario','=','cs.co_usuario')
                        ->whereIn('co.co_usuario',$users)
                        ->whereBetween('cf.data_emissao',[$start,$end])
                        ->groupby('usu.co_usuario','mes')
                        ->get()
                         ->map(function ($rel) use($rela){
                     
                            return $rela->push([
                                    "mes"           => $rel->mes,
                                    "period"        => $rel->period,
                                    "no_usuario"    => $rel->no_usuario,
                                    "co_usuario"    => $rel->co_usuario,
                                    "custo_fixo"    => $rel->custo_fixo,
                                    "valor"         => $rel->valor,
                                    "impuesto"      => $rel->total_imp_inc,
                                    "receita"       => $rel->receita,
                                    "comissao"      => $rel->comissao,
                                    ]);
                           
                        });

                    //$array['items']         =[];
                    /* $consultor[] =[];
                    $array['items']         =[];

                    foreach($relatorio as $key=>$rel){

                       // $consultor['consultor'][$key] = $rela['co_usuario'];
                        $array['items'][$rel['co_usuario']][] = $rel;

                        /* $rela->push([
                                "consultor" => $rel['co_usuario'],
                                "items"     => $rel
                            ]); 
                    } */
                    //$array = $rela->groupBy('co_usuario');
                    /* $consultores = [];
                     for($i=0; $i <= count($array); $i++){
                        //$array['items'][$key] = $rel['co_usuario']; 
                        //$array[] = $rela->groupBy('co_usuario');
                        //dd($i, count($array), $array);
                        $consultores[$i] = $array[$i];
                    }   */
       // dd($array);
                    
        //dd($rela->groupBy('co_usuario'));
        //$array[] = $rela->groupBy('co_usuario');
        return response()->json($rela);
    }

    public function getGraficoConsultores(Request $request)
    {
        $consultores    = $request->all();
        $users          =  $request->input('consultores');
        $start          =  $request->input('start');
        $end            =  $request->input('end');
 
          $relatorio = \DB::table('cao_fatura as cf')
                         ->select('usu.no_usuario','usu.co_usuario','cs.brut_salario as custo_fixo',
                                 DB::raw('MONTH(cf.data_emissao) as mesEmissao'),
                                 DB::raw('MONTH(cf.data_emissao) as yearEmissao'), 
                                 DB::raw('SUM(((cf.valor * cf.total_imp_inc)/100)) as receita'),
                                 DB::raw('SUM(((cf.valor - ((cf.valor * cf.total_imp_inc)/100)))*cf.comissao_cn) as comissao'),
                                 DB::raw('SUM((cf.valor - ((cf.valor * cf.total_imp_inc)/100)) -((cf.valor - (cf.valor - ((cf.valor * cf.total_imp_inc)/100)))*cf.comissao_cn)+cs.brut_salario) as lucro')
                                 )
                         ->join('cao_os as co','cf.co_os','=','co.co_os')
                         ->join('cao_usuario as usu','usu.co_usuario','=','co.co_usuario')
                         ->join('cao_salario as cs','co.co_usuario','=','cs.co_usuario')
                         ->whereIn('co.co_usuario',$users)
                         ->whereBetween('cf.data_emissao',[$start,$end])
                         ->groupby('usu.co_usuario')
                         ->get();
                  
         return response()->json($relatorio);
    }
}
