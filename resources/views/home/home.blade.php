@extends('layouts.dashboard')

@section('content')

    {{--@can('admin')--}}
    {{--<div class="row tile_count">--}}
        {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
            {{--<span class="count_top"><i class="fa fa-user"></i> Total de Usuários</span>--}}
            {{--<div class="count">2500</div>--}}
            {{--<span class="count_bottom"><i class="green">4% </i> From last Week</span>--}}
        {{--</div>--}}
        {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
            {{--<span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>--}}
            {{--<div class="count">123.50</div>--}}
            {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>--}}
        {{--</div>--}}
        {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
            {{--<span class="count_top"><i class="fa fa-user"></i> Total Males</span>--}}
            {{--<div class="count green">2,500</div>--}}
            {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
        {{--</div>--}}
        {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
            {{--<span class="count_top"><i class="fa fa-user"></i> Total Females</span>--}}
            {{--<div class="count">4,567</div>--}}
            {{--<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>--}}
        {{--</div>--}}
        {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
            {{--<span class="count_top"><i class="fa fa-user"></i> Total Collections</span>--}}
            {{--<div class="count">2,315</div>--}}
            {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
        {{--</div>--}}
        {{--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">--}}
            {{--<span class="count_top"><i class="fa fa-user"></i> Total Connections</span>--}}
            {{--<div class="count">7,325</div>--}}
            {{--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--@endcan--}}
            <!-- /top tiles -->


    <br/>


    <div class="row">
        @cannot('admin')
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Sugestão de procedimento</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">

                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="dashboard-widget-content">
                        <form id="suggestionNew">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sugestão</label>
                                    <p class="text-warning">Serve para sugestão de novos procedimentos ou questionar
                                        algum
                                        procedimento.</p>
                                    <textarea id="suggestion" rows="5" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-default">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endcannot
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Novos procedimentos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="dashboard-widget-content">

                        <ul class="list-unstyled timeline widget">

                            @forelse($lastProcedures as $procedure)
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a>Procedimento :{{$procedure->name}}</a><br>
                                                <a>Categoria :{{$procedure->category->name}}</a>
                                            </h2>
                                            <div class="byline">
                                                <span>{{$procedure->date_publish->diffInHours(\Carbon\Carbon::now())}}
                                                    horas atrás</span>
                                                por
                                                <a>{{ \Illuminate\Support\Facades\Auth::user()->find($procedure->lastRevision()[0]->approved)->name }}</a>
                                            </div>
                                            <p class="excerpt">{{$procedure->lastRevision()[0]->description}}
                                                {{--<a href="procedure/{{$procedure->id}}">Leia&nbsp;mais</a>--}}
                                            </p>
                                        </div>
                                    </div>
                                </li>


                            @empty

                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a>Sem novos procedimentos</a>
                                            </h2>
                                        </div>
                                    </div>
                                </li>

                            @endforelse


                            {{--<li>--}}
                            {{--<div class="block">--}}
                            {{--<div class="block_content">--}}
                            {{--<h2 class="title">--}}
                            {{--<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>--}}
                            {{--</h2>--}}
                            {{--<div class="byline">--}}
                            {{--<span>13 hours ago</span> by <a>Jane Smith</a>--}}
                            {{--</div>--}}
                            {{--<p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>--}}
                            {{--</p>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<div class="block">--}}
                            {{--<div class="block_content">--}}
                            {{--<h2 class="title">--}}
                            {{--<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>--}}
                            {{--</h2>--}}
                            {{--<div class="byline">--}}
                            {{--<span>13 hours ago</span> by <a>Jane Smith</a>--}}
                            {{--</div>--}}
                            {{--<p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>--}}
                            {{--</p>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<div class="block">--}}
                            {{--<div class="block_content">--}}
                            {{--<h2 class="title">--}}
                            {{--<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>--}}
                            {{--</h2>--}}
                            {{--<div class="byline">--}}
                            {{--<span>13 hours ago</span> by <a>Jane Smith</a>--}}
                            {{--</div>--}}
                            {{--<p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>--}}
                            {{--</p>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<div class="block">--}}
                            {{--<div class="block_content">--}}
                            {{--<h2 class="title">--}}
                            {{--<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>--}}
                            {{--</h2>--}}
                            {{--<div class="byline">--}}
                            {{--<span>13 hours ago</span> by <a>Jane Smith</a>--}}
                            {{--</div>--}}
                            {{--<p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>--}}
                            {{--</p>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#suggestionNew').submit(function (e) {
                e.preventDefault();
                request('suggestions', 'post', {suggestion: $('#suggestion').val()}).then(function (response) {
                    swal({
                        title: 'Enviada',
                        text: 'O sugestão foi enviado',
                        type: 'success'
                    })
                });
                $('#suggestion').val('');
            });
        });
    </script>


@endsection