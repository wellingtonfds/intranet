@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="page-header">
            <h1>Post
                <small> Lista de posts</small>
            </h1>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <button class="btn btn-default" data-toggle="modal" data-target="#newCategory">Novo</button>
            </div>
        </div>
        <table class="table table-striped hover">
            <thead>
            <th>Título</th>
            <th>Status</th>
            <th>Data criação</th>
            <th>Ações</th>
            </thead>
            <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{$post->title}}</td>
                    <td>{{$post->status_post_id}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>
                        <button class="btn btn-primary btn-xs editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                        <button class="btn btn-danger btn-xs excluir">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                        <button class="btn btn-success btn-xs view">
                            <span class="glyphicon glyphicon-eye-open" title="Revisões do procedimento"></span>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td rowspan="4">Sem posts</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="col-md-12 col-sm-12 col-xs-12">

        </div>
    </div>
@endsection
@section('scripts')
@endsection