<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Empresa;
use App\Models\EmpresaPlan;
use App\Models\EmpresaTipoEntrega;
use App\Models\EmpresaTipoPago;
use App\Models\Producto;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function empresa(Request $request){
        
        $slug   = $request->input('slug');
        $arreglo = array();
		$menu 	 = array();

        $empresa = Empresa::where(['slug' => $slug])->first();

		//EMPRESA NO EXISTENTE
		if( empty($empresa) ){
			$arreglo['existe']	= FALSE;
			$arreglo['limite']	= FALSE;
            
			return response()->json([
                'error' => TRUE,
                'info'  => $arreglo
            ], 201);
		}

		//EMPRESA CON VISTAS EXCEDIDO
		if( !$empresa->vista ){
			$arreglo['existe']	= TRUE;
			$arreglo['limite']	= TRUE;            
			return response()->json([
                'error' => TRUE,
                'info'  => $arreglo
            ], 201);
		}

        $user = User::find($empresa->user_id);
		$arreglo['empresa']	= $empresa ? $empresa : NULL;
		$arreglo['menu']	= null;

        if( $user->email_verified_at ){

			$grupos 	= $user->grupos;
			$plan 		= EmpresaPlan::where(['user_id' => $user->id, 'en_uso' => TRUE ])->first();
			$limitImg	= $plan->plan->img;

			$i = 0;
			foreach( $grupos as $grupo ){
				$menu[$i]['GRUPO'] = $grupo;
				$productos = Producto::where(['grupo_id' => $grupo->id, 'flag' => TRUE ])->get();
				$menu[$i]['COUNT_PRODUCTOS'] = count($productos);
                
				foreach( $productos as $producto ){
					
					$menu[$i]['PRODUCTOS'][] = array( 
														'PRODUCTO_ID'		=> $producto->id, 
														'PRODUCTO_NOMBRE'	=> $producto->producto, 
														'PRODUCTO_DET' 		=> $producto->detalle, 
														'PRODUCTO_DESC' 	=> $producto->descripcion, 
														'PRODUCTO_LINKED' 	=> $producto->link,
														'BASE' 	            => $producto->base, 
														'VALORES' 			=> $producto->valores, 
														'IMAGENES' 			=> ProductoImagen::where(['producto_id' => $producto->id, 'flag' => TRUE ])->take($limitImg)->get()
													);
				}
				$i++;
			}
			
			$arreglo['menu']		    = $menu;
			$arreglo['TIPO_ENTREGA']	= EmpresaTipoEntrega::where(['user_id' => $user->id, 'flag' => TRUE ])->get();
			$arreglo['TIPO_PAGO']	    = EmpresaTipoPago::where(['user_id' => $user->id, 'flag' => TRUE ])->get();

        }


        return response()->json([
            'error' => FALSE,
            'info'  => $arreglo
        ], 201);
    }
}
