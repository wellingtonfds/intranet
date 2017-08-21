@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <img src="{{asset('img/lyon_email.jpg')}}" style="width: 100%;margin-bottom: 5px">
        </div>
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