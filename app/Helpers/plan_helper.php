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
                $mdl    = EmpresaPlan::where(['user_id' => $idUser, 'flag' => TRUE])->first();

		$ahora 		= Carbon::now();
		$hasta          = $mdl->hasta;
		$txtCron        = '';
                $file		= "cron_membresia.txt";

		if( $ahora > $hasta ){
			$plan		= $mdl->plan_id;
			$idEmpPlan	= $mdl->id;
                        
                        EmpresaPlan::where('user_id', $idUser)
                                        ->where('id', $idEmpPlan)
                                        ->update(['flag' => FALSE]);
                                        
                        $membresiasTotal = EmpresaPlan::where(['user_id' => $idUser, 'flag' => TRUE])->get();
			if( count($membresiasTotal) == 0 ){
                                instanciarPlan($empresa,1);
			}

			$txtCron = $ahora . ' USER: ' . $idUser . ' IDCAMPO: '.$idEmpPlan.' PLAN: ' .$plan. "\n";
                        logCron($file,$txtCron);
		}
        }
}