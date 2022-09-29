<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Contacto</title>
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
        #contenido{
            background-color: #d9fad5;
            padding: 20px;
        }
        p{
            color: #666;
            font-size: 20px;
            line-height: 25px;
            text-align: left;
        }
        img{
            width: 40%;
            display: block;
            margin: 10px auto 0;
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

        <h1>Formulario de Contacto</h1>

        <hr>

        <div id="contenido">

            <p>
                Usuario: {{ $empresa->user->name }}<br>
                Email: {{ $empresa->user->email }}<br>
                Empresa: {{ $empresa->empresa }}<br>
                Ha escrito el siguiente mensaje:
            </p>

            <p>
                {{ $mensaje }}
            </p>

        </div>

        <p class="footer"><a href="https://www.facilbak.cl/" target="_blank">Procesado por FACILBAK QR.</a></p>
        
    </body>
</html>