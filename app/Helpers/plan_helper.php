<?php

use App\Models\Empresa;
use App\Models\EmpresaPlan;
use Illuminate\Support\Carbon;

if(!function_exists('instanciarPlan'))
{
        function instanciarPlan($empresa,$plan)
        {
                $bool = $plan != 1 ? TRUE : FALSE;
                Empresa::where('id', $empresa->id)
                        ->update(['membresia' => $bool, 'vista' => TRUE]);
                        
                EmpresaPlan::create([
                    'user_id'   => $empresa->user_id,
                    'pago_id'   => NULL,
                    'plan_id'   => $plan,
                    'desde'     => Carbon::now(),
                    'hasta'     => Carbon::now()->addMonths(1),
                    'en_uso'    => TRUE,
                    'en_uso'    => TRUE,
                    'free'      => TRUE
                ]);
        }
}

if(!function_exists('avisoPlan'))
{
        function avisoPlan($idUser)
        {

                $msn                    = '';
                $diasAviso              = 5;
                $membresiaActual = EmpresaPlan::where(['user_id' => $idUser, 'flag' => TRUE])->first();
                $membresiasTotal = EmpresaPlan::where(['user_id' => $idUser])->get();

                if( $membresiaActual->plan_id == 1 ){
                        $msn  = '<div class="alert alert-warning alert-dismissible fade show">';
                        $msn .= '<h5 class=text-center><strong>ESTÁS EN PLAN BRONCE,<br> MEJORA TU EXPERIENCIA CONTRATANDO TU MEMBRESÍA</strong></h5>';
                        $msn .= '</div>';
                }else{
                        $diasResta  = diffEntreDosfecha($membresiaActual->hasta);
                        if( ($diasResta <= $diasAviso) && (count($membresiasTotal) == 1) ){
                                $msn  = '<div class="alert alert-danger alert-dismissible fade show">';
                                $msn .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                $msn .= '<h5 class=text-center><strong>TE QUEDAN '.$diasResta.' DÍAS DE TU PLAN '.$membresiaActual->MEMBRESIA_NOMBRE.', <br> RENUÉVALA AHORA.</strong></h5>';
                                $msn .= '</div>';
                        }
                }

                return $msn;
        }
}

if(!function_exists('downPlan'))
{
        function downPlan($empresa)
        {
                $idUser = $empresa->user_id;
                $mdl    = EmpresaPlan::where(['user_id' => $idUser, 'en_uso' => TRUE ])->first();

		$ahora 		= Carbon::now();
		$hasta          = $mdl->hasta;
		$txtCron        = '';
                $file		= "cron_membresia.txt";

		if( $ahora > $hasta ){
			$plan		= $mdl->plan_id;
			$idEmpPlan	= $mdl->id;
                        
                        EmpresaPlan::where(['user_id' => $idUser, 'id' => $idEmpPlan ])
                                          ->update(['flag' => FALSE, 'en_uso' => FALSE]);
                                        
                        $membresiasTotal = EmpresaPlan::where(['user_id' => $idUser, 'flag' => TRUE])->get();
			if( count($membresiasTotal) == 0 ){
                                instanciarPlan($empresa,1);
			}else{
                                $next = EmpresaPlan::where([ 'user_id' => $idUser, 'flag' => TRUE, 'en_uso' => FALSE ])->orderBy('id', 'asc')->first();
                                EmpresaPlan::where(['user_id' => $idUser, 'id' => $next->id ])
                                           ->update(['en_uso' => TRUE]);
                        }

			$txtCron = $ahora . ' USER: ' . $idUser . ' IDCAMPO: '.$idEmpPlan.' PLAN: ' .$plan. "\n";
                        logCron($file,$txtCron);
		}
        }
}

if(!function_exists('calcularMembresia'))
{
        function calcularMembresia($compra)
        {
                $idUser         = $compra->user_id;
                $idPlan         = $compra->plan_id;
                $idCompra       = $compra->id;
                $meses          = $compra->meses;
                $free           = isset($compra->FREE) ? TRUE : FALSE;
                
                //DAR DE BAJA PLANES DE BRONCES ASOCIADOS AL USUARIO
                EmpresaPlan::where([ 'user_id' => $idUser, 'flag' => TRUE, 'plan_id' => 1 ])->update([ 'flag' => FALSE ]);

                //capturar membresía existente
                $membresia = EmpresaPlan::where([ 'user_id' => $idUser, 'flag' => TRUE ])->orderBy('id', 'desc')->limit(1)->first();
                $inicio         = !empty($membresia) ? $membresia->hasta : fechaNow();
                
                if( $idPlan != 1 ){

                        for( $i = 0 ; $i < $meses ; $i++ ){
                                $attr           = calcMembresiaExistente($inicio);
                                $start          = $attr->start;
                                $end            = $attr->end;
                                $inicio         = $end;
                                
                                EmpresaPlan::create([
                                        'user_id'       => $idUser,
                                        'pago_id'       => $idCompra,
                                        'plan_id'       => $idPlan,
                                        'desde'         => $start,
                                        'hasta'         => $end,
                                        'free'          => $free
                                    ]);
                        }

                }else{
                        $attr           = calcMembresiaExistente($inicio);                    
                        $start          = $attr->start;
                        $end            = $attr->end;
                                
                        EmpresaPlan::create([
                                'user_id'       => $idUser,
                                'pago_id'       => $idCompra,
                                'plan_id'       => $idPlan,
                                'desde'         => $start,
                                'hasta'         => $end,
                                'free'          => TRUE
                            ]);
                }
                
                //RESET VISTA
                Empresa::where('user_id', $idUser)->update([ 'vista' => TRUE ]);
                //RESET MEMBRESÍA
                Empresa::where('user_id', $idUser)->update([ 'membresia' => TRUE ]);
        }
}

if(!function_exists('calcMembresiaExistente'))
{
	function calcMembresiaExistente($inicio)
	{
		$json = '{
                                "start": "'.$inicio.'",
                                "end": "'.hastaDate($inicio).'"
                        }';
		
		return json_decode($json);
	}
}

if(!function_exists('hastaDate'))
{
	function hastaDate($date)
	{
		$var = date('Y-m-d H:i:s', strtotime($date . ' + 1 months'));
		return $var;
	}
}