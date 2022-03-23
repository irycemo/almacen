<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo</title>
</head>

<style>

    body{
        font-size: 13px;
    }

    h1{
        font-size: 13;
        font:bold;
        margin: 0;
    }

    .header{
        margin-bottom: 5px;
        width: 100%;
        table-layout: fixed;
    }

    .data{
        text-align: right;
    }

    .table{
        width: 100%;
        table-layout: auto;
    }

    .th_table{
        background: #e2e2e2;
        padding: 5 0;
    }

    .content{
        border-bottom: 1px solid #ddd;
        padding: 5 20;
    }

    p{
        margin: 0;
    }

    img{
        width: 200px;
    }

    .text_center{
        text-align: center;
    }

    .footer{
        margin-top: 50px;
        width: 100%;
        table-layout: fixed;
        text-align: center;

    }

    .footer tbody {
        vertical-align: top;
    }

    .linea{
        width: 50%;
        border-top: 1px solid black;
    }

    .page-break{
        page-break-after: always;
    }

</style>

<body>

    <div class="page-break">

        <table class="header">

            <thead>

                <tr>

                    <th>

                        <img src="{{ public_path('storage/img/logo2.png') }}" alt="Logo">

                    </th>

                    <th>

                        <h1>Recibo de entrega</h1>
                        <p>Sistema de Almacen</p>

                    </th>

                    <th class="data">

                        <p>Solicitud número: {{ $request->number }}</p>
                        <p>Entregado por: {{ $user }}, el </p>
                        <p><p>{{ $request->updated_at }}</p></p>

                    </th>

                </tr>

            </thead>

        </table>

        <table class="table">

            <thead class="th_table">

                <tr >

                    <th>Cantidad</th>
                    <th>Nombre / Marca / #Serie</th>

                </tr>

            </thead>


            <tbody >

                @foreach($request_content as $item)

                    <tr>

                        <td class="content text_center">
                            <p >{{ $item['quantity'] }}</p>
                        </td>

                        <td class="content">
                            <p>
                                {{ $item['article'] }} / {{ $item['brand'] }}
                                @if (isset($item['serial']))
                                    / {{ $item['brand'] }}
                                @endif
                            </p>
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <table class="footer">

            <thead class="text-center">

            <tbody>

                <tr>

                    <td  class="text-center">
                        <p class="linea text-center" >Sello</p>
                    </td>

                    <td  class="text-center">

                        <div class="linea">
                            <p >Solicitante</p>
                            <p>{{ $solicitante }}</p>
                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <div >

        <table class="header">

            <thead>

                <tr>

                    <th>

                        <img src="{{ public_path('storage/img/logo2.png') }}" alt="Logo">

                    </th>

                    <th>

                        <h1>Recibo de entrega</h1>
                        <p>Sistema de Almacen</p>

                    </th>

                    <th class="data">

                        <p>Solicitud número: {{ $request->number }}</p>
                        <p>Entregado por: {{ $user }}, el </p>
                        <p><p>{{ $date }}</p></p>

                    </th>

                </tr>

            </thead>

        </table>

        <table class="table">

            <thead class="th_table">

                <tr >

                    <th>Cantidad</th>
                    <th>Nombre / Marca / #Serie</th>

                </tr>

            </thead>


            <tbody >

                @foreach($request_content as $item)

                    <tr>

                        <td class="content text_center">
                            <p >{{ $item['quantity'] }}</p>
                        </td>

                        <td class="content">
                            <p>
                                {{ $item['article'] }} / {{ $item['brand'] }}
                                @if (isset($item['serial']))
                                    / {{ $item['brand'] }}
                                @endif
                            </p>
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <table class="footer">

            <thead class="text-center">

            <tbody>

                <tr>

                    <td  class="text-center">
                        <p class="linea text-center" >Sello</p>
                    </td>

                    <td  class="text-center">

                        <div class="linea">
                            <p >Solicitante</p>
                            <p>{{ $solicitante }}</p>
                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</body>
</html>
