@extends('layouts.app')

@section('content')
    @component('components.menuleft')

    @endcomponent
    <div class="w3-col m7" >
        <div class="w3-row-padding">
            <div class="w3-col m12">
                @if($costs=='null')
                    <span class="w3-tag w3-small w3-yellow">Sem conexão com banco de dados</span>
                @else
                    <div class="w3-panel w3-border w3-light-grey w3-round-large w3-padding-24">
                        {{ucfirst($choice)}}
                    </div>
                    <table class="w3-table-all w3-hoverable">
                        <tr>
                            <td>CC</td>
                            <td>desc</td>
                            <td>Analista</td>
                        </tr>
                        @forelse($costs as $cost)
                            <tr>
                                <td>{{$cost->Usu_CodCcu}}</td>
                                <td>{{$cost->Usu_DesCcu}}</td>
                                <td>{{$cost->Usu_NomCto}}</td>
                            </tr>
                        @empty

                        @endforelse
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection