<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Comprobante de pago {{ $compra->orden }}</title>
        <style>
        h1{
            font-size: 25px;
            text-align: center;
            text-transform: uppercase;
        }
        h2{
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;
        }
        img{
            width: 15%;
            float: left;
            margin-top: -20px;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        tr:nth-child(even){
            background-color: #f2f2f2;
        }
        td{
            text-align: right;
            text-transform: uppercase;
            width: 50%;
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
    </head>
    <body>

        <img src="{{ public_path('images/logo.png') }}" alt="FacilbakQR" />

        <h1>COMPROBANTE DE PAGO</h1>
        <hr>
        <h2>DETALLE</h2>

        <table>
            <tr>
                <td>ORDEN DE COMPRA</td>
                <td>{{ $compra->orden }}</td>
            </tr>
            <tr>
                <td>PLAN</td>
                <td>{{ $compra->plan->plan }}</td>
            </tr>
            <tr>
                <td>CANTIDAD</td>
                <td>{{ $compra->meses }}</td>
            </tr>
            <tr>
                <td>NETO</td>
                <td>{{ formatMoney($compra->neto) }}</td>
            </tr>
            <tr>
                <td>IVA</td>
                <td>{{ formatMoney($compra->iva) }}</td>
            </tr>
            <tr>
                <td>TOTAL</td>
                <td>{{ formatMoney($compra->total) }}</td>
            </tr>
            <tr>
                <td>FECHA</td>
                <td>{{ Carbon\Carbon::parse($compra->created_at)->format('d-m-Y H:i') }}</td>
            </tr>
            <tr>
                <td>PAGO CON</td>
                <td>WEBPAY</td>
            </tr>
            <tr>
                <td>TARJETA N°</td>
                <td>**** **** **** {{ $compra->request->card_number }}</td>
            </tr>
            <tr>
                <td>TIPO DE PAGO</td>
                <td>{{ tipoPago($compra->request->payment_type_code) }}</td>
            </tr>
            @if ( $compra->request->installments_number )
                <tr>
                    <td>N° DE CUOTAS</td>
                    <td>{{ $compra->request->installments_number }}</td>
                </tr>                
            @endif
        </table>
        
    </body>
</html>