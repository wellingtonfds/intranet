@extends('layouts.app')
@section('content')
    @component('components.menuleft')
    @endcomponent
    <!-- Middle Column -->
    <div class="w3-col m6">
        @if($posts->total() > 5)
            <div class="w3-container w3-card-2 w3-white w3-round w3-margin w3-padding-small">
                {{$posts->links()}}
            </div>
        @endif
        @forelse($posts as $post)
            <div class="w3-container w3-card-2 w3-white w3-round w3-margin-left w3-margin-right w3-margin-bottom"><br>
                <span class="w3-right w3-opacity">{{$post->created_at->format('d/m/Y H:i')}}</span>
                <h4>{{$post->title}}</h4>
                <hr class="w3-clear">
                <div class="w3-row-padding" style="margin:0 -16px">
                    <div class="w3-half">
                        @if(empty($post->featured))
                            <h4>{{$post->title}}</h4>
                        @else
                            <img src="{{Storage::url($post->featured)}}" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
                        @endif
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
    <div class="w3-col m3">
        <div class="w3-card-2 w3-round w3-white w3-center w3-padding-16">
            <div class="w3-container">
                <h4>Aniversáriantes</h4>
                @if($birthDays=='null')
                    <span class="w3-tag w3-small w3-yellow">Sem conexão com banco de dados</span>
                @else
                    @forelse($birthDays as $birthDay)
                        <div class="w3-light-grey w3-hover-shadow w3-center w3-padding-16">
                        @php
                            $name = explode(' ',$birthDay->nomfun);
                            if(count($name)>=1){
                                echo "<span><b>".$name[0]." ".$name[1]."</b></span><br>";
                            }else{
                                echo "<span><b>".$birthDay->nomfun."</b></span><br>";
                            }
                        @endphp

                        <span>{{$birthDay->nomloc}}</span>
                        </div>
                        <br>
                    @empty
                        <span class="w3-tag w3-small w3-yellow">Sem aniversariantes</span>
                    @endforelse
                @endif

            </div>
        </div>
        <br>

        <!-- End Right Column -->
    </div>
    <!-- End Right Column -->
@endsection