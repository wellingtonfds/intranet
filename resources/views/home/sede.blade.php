@extends('layouts.app')

@section('content')
@component('components.menuleft')

@endcomponent
<div class="w3-col m9">
    <div class="w3-row-padding">
        <div class="w3-col m12" <div class="w3-panel w3-border w3-light-grey w3-round-large w3-padding-24">
            <h2 class="w3-center">Sede</h2>
        </div>
        <table class="w3-table-all w3-hoverable">
            <tr>
                <td><b>Centro de custo</b></td>
                <td><b>Descrição</b></td>

            </tr>
            @foreach ($cc as $item)
            <tr>
                <td class="w3-small">{{$item->CodCcu}}</td>
                <td class="w3-small">{{$item->DesCcu}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
</div>
@endsection
@section('scripts')
@endsection