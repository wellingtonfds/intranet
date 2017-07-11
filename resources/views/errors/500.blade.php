<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/404.css')}}"/>
</head>
<body>
<div class="wrapper row2">
    <div id="container" class="clear">
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
        <section id="fof" class="clear">
            <!-- ####################################################################################################### -->
            <div class="hgroup">
                <h1><span><strong>5</strong></span><span><strong>0</strong></span><span><strong>0</strong></span></h1>
                <h2>Erro! <span>Interno no servidor</span></h2>
            </div>
            <p>{{$exception->getMessage()}}</p>
            {{--<p><a href="javascript:history.go(-1)">&laquo; Voltar</a> | <a href="#">Solicitar Permissão</a> | <a href="#"> Home &raquo;</a> </p>--}}
            <!-- ####################################################################################################### -->
        </section>
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
        <!-- ####################################################################################################### -->
    </div>
</div>

</body>
</html>