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
        <div class="w3-container w3-card-2 w3-white w3-round w3-margin w3-padding-small">
            {{$posts->links()}}
        </div>
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
        <div class="w3-container w3-card-2 w3-white w3-round w3-margin w3-padding-small">
            {{$posts->links()}}
        </div>

    </div>
    <!-- End Middle Column -->
    <!-- Right Column -->
    <div class="w3-col m2">
        <div class="w3-card-2 w3-round w3-white w3-center">
            <div class="w3-container">
                <p>Upcoming Events:</p>
                <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
                <p><strong>Holiday</strong></p>
                <p>Friday 15:00</p>
                <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
            </div>
        </div>
        <br>

        <div class="w3-card-2 w3-round w3-white w3-center">
            <div class="w3-container">
                <p>Friend Request</p>
                <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
                <span>Jane Doe</span>
                <div class="w3-row w3-opacity">
                    <div class="w3-half">
                        <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
                    </div>
                    <div class="w3-half">
                        <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="w3-card-2 w3-round w3-white w3-padding-16 w3-center">
            <p>ADS</p>
        </div>
        <br>

        <div class="w3-card-2 w3-round w3-white w3-padding-32 w3-center">
            <p><i class="fa fa-bug w3-xxlarge"></i></p>
        </div>

        <!-- End Right Column -->
    </div>
    <!-- End Right Column -->
@endsection