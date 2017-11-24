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
                <a href="/post/create" target="_blank" class="btn btn-default">Novo</a>
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
                        <input type="hidden" class="id-post" value="{{$post->id}}">
                        <a href="/post/{{$post->id}}/edit" target="_blank" class="btn btn-primary btn-xs editar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <button class="btn btn-danger btn-xs excluir">
                            <span class="glyphicon glyphicon-trash"></span>
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