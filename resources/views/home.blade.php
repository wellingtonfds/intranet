@extends('layouts.app')
@section('content')
    @component('components.menuleft')

    @endcomponent
    <!-- Middle Column -->
    <div class="w3-col m7">
        <div class="w3-row-padding">
            <div class="w3-col m12">
                <div class="w3-card-2 w3-round w3-white">
                    <div class="w3-container w3-padding">
                        <h6 class="w3-opacity">Social Media template by w3.css</h6>
                        <p contenteditable="true" class="w3-border w3-padding">Status: Feeling Blue</p>
                        <button type="button" class="w3-button w3-theme"><i class="fa fa-pencil"></i>  Post</button>
                    </div>
                </div>
            </div>
        </div>

        @if($posts->total() > 5)
            <div class="w3-container w3-card-2 w3-white w3-round w3-margin w3-padding-small">
                {{$posts->links()}}
            </div>
        @endif
        @forelse($posts as $post)
            <div class="w3-container w3-card-2 w3-white w3-round w3-margin"><br>
                <span class="w3-right w3-opacity">{{$post->created_at->format('d/m/Y H:i')}}</span>
                <h4>{{$post->title}}</h4>
                <hr class="w3-clear">
                <div class="w3-row-padding" style="margin:0 -16px">
                    <div class="w3-half">
                        <img src="{{Storage::url($post->featured)}}" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
                    </div>

                </div>
                <a href="/post/{{$post->id}}" type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Detalhes</a>
            </div>
        @empty
            <p>Sem posts</p>
        @endforelse
        @if($posts->total() > 5)
            <div class="w3-container w3-card-2 w3-white w3-round w3-margin w3-padding-small">
                {{$posts->links()}}
            </div>
        @endif

    </div>
    <!-- End Middle Column -->
    <!-- Right Column -->
    <div class="w3-col m2">

        <div class="w3-card-2 w3-round w3-white w3-center">
            <div class="w3-container">
                <h4>Aniversáriantes</h4>
                <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
                <span>Jane Doe</span>
            </div>
        </div>
        <br>

        <!-- End Right Column -->
    </div>
    <!-- End Right Column -->
@endsection