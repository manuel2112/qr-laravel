<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Compra;
use App\Mail\PayMailable;
use Illuminate\Http\Request;
use App\Models\ComprasRequest;
use Transbank\Webpay\WebpayPlus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Transbank\Webpay\WebpayPlus\Transaction;

class PayController extends Controller
{
    public function __construct()
    {
        if( app()->environment('production') ){
            WebpayPlus::configureForProduction(
                env('webpay_plus_cc'),
                env('webpay_plus_api_key')
            );
        }else{
            WebpayPlus::configureForTesting();
        }
    }

    public function index(){
        return view('pay.index');
    }

    public function pay(){
        $compra     = Session::get('compra');
        $plan       = Session::get('plan');
        $url_to_pay = '';
        $token      = '';
        $time       = Carbon::now()->format('d-m-Y H:i');

        if( $compra ){        
            $transaccion = (new Transaction)->create(
                $compra->id,
                $compra->session_id,
                $compra->total,
                route('pay.result')
            );

            $url_to_pay = $transaccion->getUrl();
            $token      = $transaccion->getToken();

            Compra::where('id', $compra->id)->update([ 'token' => $token ]);
        }
        return view('pay.pay', [
            'compra'        => $compra,
            'plan'          => $plan,
            'url_to_pay'    => $url_to_pay,
            'token'         => $token,
            'time'          => $time
        ]);
    }

    public function result(Request $request){

        $response = '';
        $existe = Compra::where(['token' => $request->token_ws, 'status' => 2])->first();
        if( $existe ){
            return redirect()->route('pay.miscompras');
        }

        if( $request->token_ws ){
            $response = (new Transaction)->commit($request->token_ws);
            Compra::where('token', $request->token_ws)->update([ 'status' => 2, 'deleted_at' => date('Y-m-d H:i:s') ]);
            ComprasRequest::create([
                'compra_id'             => $response->buyOrder,
                'accounting_date'       => $response->accountingDate,
                'card_number'           => $response->cardNumber,
                'amount'                => $response->amount,
                'authorization_code'    => $response->authorizationCode,
                'payment_type_code'     => $response->paymentTypeCode,
                'response_code'         => $response->responseCode,
                'transaction_date'      => $response->transactionDate,
                'vci'                   => $response->vci,
                'status'                => $response->status,
                'installments_amount'   => $response->installmentsAmount,
                'installments_number'   => $response->installmentsNumber,
                'balance'               => $response->balance
            ]);
            // SI EL PAGO ESTÁ AUTORIZADO
            if( $response->status == 'AUTHORIZED' ){

                //INGRESAR PLANES COMPRADOS
                $compra = Compra::where('token', $request->token_ws)->first();
                calcularMembresia($compra);

                //ENVIAR MAIL COMPROBANTE DE PAGO
                Mail::to(auth()->user()->email)->send(new PayMailable($compra));

                //CREAR LOG
                payLog($compra->orden, $response);

            }

        }else{
            $request->TBK_TOKEN;
            $request->TBK_ORDEN_COMPRA;
            $request->TBK_ID_SESION;
        }
        
        return view('pay.result', [
            'request'  => $request,
            'response' => $response
        ]);
    }

    public function miscompras(){

        $compras = Compra::where( ['user_id' => auth()->user()->id, 'status' => 2 ] )->orderBy('id', 'desc')->get();
        
        return view('pay.miscompras', [
            'compras'  => $compras
        ]);        
    }
}
