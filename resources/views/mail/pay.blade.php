<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Comprobante de pago #{{ $data->orden }}</title>
        <style>
        body{
            width: 50%;
            margin: 0 auto;
        }
        h1{
            font-size: 25px;
            text-align: center;
            text-transform: uppercase;
        }
        p{
            color: #666;
            font-size: 20px;
            line-height: 25px;
            text-align: left;
        }
        p a {
            color: #00acff;
            text-decoration: none;
        }
        p a:hover {
            text-decoration: underline;
        }
        img{
            width: 40%;
            display: block;
            margin: 10px auto 0;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        tr:nth-child(even){
            background-color: #f2f2f2;
        }
        td{
            border: 1px solid #ddd;
            text-transform: uppercase;
            width: 50%;
            padding: 8px;
        }
        td.left{
            text-align: left;
        }
        td.right{
            text-align: right;
        }
        p.footer{
            color: #666;
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }
        p.footer a {
            color: #666;
            text-decoration: none;
        }
        p.footer a:hover {
            text-decoration: underline;
        }
    </style>
    </head>
    <body>

        <img src="https://www.facilbak.cl/assets/mailing/images/img-12.png" alt="FacilbakQR" />

        <h1>COMPROBANTE DE PAGO</h1>

        <hr>
        
        <p>El pago por el pedido #<strong>{{ $data->orden }}</strong> en <a href="https://www.facilbak.cl/" target="_blank">FACILBAK QR</a> ha sido procesado de manera correcta. Se adjuntan los datos de la transacción :</p>

        <table>
            <tr>
                <td class="left">ORDEN DE COMPRA</td>
                <td class="right">{{ $data->orden }}</td>
            </tr>
            <tr>
                <td class="left">PLAN</td>
                <td class="right">{{ $data->plan->plan }}</td>
            </tr>
            <tr>
                <td class="left">CANTIDAD</td>
                <td class="right">{{ $data->meses }}</td>
            </tr>
            <tr>
                <td class="left">NETO</td>
                <td class="right">{{ formatMoney($data->neto) }}</td>
            </tr>
            <tr>
                <td class="left">IVA</td>
                <td class="right">{{ formatMoney($data->iva) }}</td>
            </tr>
            <tr>
                <td class="left">TOTAL</td>
                <td class="right">{{ formatMoney($data->total) }}</td>
            </tr>
            <tr>
                <td class="left">FECHA</td>
                <td class="right">{{ Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i') }}</td>
            </tr>
            <tr>
                <td class="left">PAGO CON</td>
                <td class="right">WEBPAY</td>
            </tr>
            <tr>
                <td class="left">TARJETA N°</td>
                <td class="right">**** **** **** {{ $data->request->card_number }}</td>
            </tr>
            <tr>
                <td class="left">TIPO DE PAGO</td>
                <td class="right">{{ tipoPago($data->request->payment_type_code) }}</td>
            </tr>
            @if ( $data->request->installments_number )
                <tr>
                    <td class="left">N° DE CUOTAS</td>
                    <td class="right">{{ $data->request->installments_number }}</td>
                </tr>                
            @endif
        </table>

        <p class="footer"><a href="https://www.facilbak.cl/" target="_blank">Procesado por FACILBAK QR.</a></p>
        
    </body>
</html>