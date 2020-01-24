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
        $arrayConsultores = [];
        return view('administrativo.index',compact('arrayConsultores'));
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
    
        $users          = $request->consultores;
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
                           
                        })->groupBy('no_usuario');
      
                    
                        $arrayConsultores[] = $rela->groupBy('no_usuario');
        

        return view('administrativo.index',compact('arrayConsultores'));
    }

    public function getGraficoConsultores(Request $request)
    {
        $consultores    = $request->all();
        $start          =  $request->input('start');
        $end            =  $request->input('end');
        $users          = str_replace(['[', ']'], '', json_encode($request->consultores));
        $arreglo        = [];
        $bandera        = '';
        $indice         = 0;
        $meses          = 0;
        
        $graficoConsultores = DB::select("
                select 
                        s.co_usuario, 
                        date_format(f.data_emissao, '%Y-%m') as periodo, 
                        round(sum((f.valor - ((f.valor * f.total_imp_inc) / 100))),2) AS receita,
                        (select no_usuario from cao_usuario where co_usuario=s.co_usuario) as name
                from 
                        cao_fatura as f inner join cao_os as s 
                        on (f.co_os = s.co_os) 
                where   co_usuario in ($users)  and (f.data_emissao BETWEEN ? and ?)
                group by s.co_usuario, periodo", [$start, $end]
            );
            

        $consulta = new Collection( $graficoConsultores );

        foreach ($consulta as $key=>$rel) {
            if ($rel->co_usuario !== $bandera) {
                
                $bandera = $rel->co_usuario;
                $arreglo[++$indice] = ['name' => $rel->name, 'type' => 'column', 'datos' => array_fill(0, 12, 0.0)];
            }
            $meses = (int)substr($rel->periodo, 5);
            
            $arreglo[$indice]['datos'][$meses - 1] += $rel->receita;
        }

        $media = DB::selectOne("select round(IFNULL(AVG(brut_salario),0),2) avg from cao_salario where co_usuario in ($users)");
        
        $arreglo[++$indice] = ['type' => 'spline', 'name' => 'Custo Fixo Médio', 'datos' => array_fill(0, 12, $media->avg * 1.0)];
 
        return response()->json($arreglo);
    }

    public function getPizzaConsultores(Request $request)
    {
        
        $start          =  $request->input('start');
        $end            =  $request->input('end');
        $users          = str_replace(['[', ']'], '', json_encode($request->consultores));
        
        
        $pizzaConsultores = DB::select("
                select 
                        s.co_usuario, 
                        date_format(f.data_emissao, '%Y-%m') as periodo, 
                        round(sum((f.valor - ((f.valor * f.total_imp_inc) / 100))),2) AS receita,
                        (select no_usuario from cao_usuario where co_usuario=s.co_usuario) name
                        
                from 
                        cao_fatura as f inner join cao_os as s 
                        on (f.co_os = s.co_os) 
                where   co_usuario in ($users)  and (f.data_emissao BETWEEN ? and ?) group by s.co_usuario", [$start, $end]
            );

        //$consulta = new Collection( $graficoConsultores );
       // dd($pizzaConsultores);

        return response()->json($pizzaConsultores);
    }
}
