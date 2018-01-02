@extends('layouts.app')

@section('content')
    @component('components.menuleft')

    @endcomponent
    <div class="w3-col m9" >
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
                            <td>Descrição</td>
                            <td>Cargo</td>
                            <td>Funcionário(a)</td>
                            <td>Data Base</td>
                        </tr>
                        @forelse($costs as $cost)
                            <tr>
                                <td class="w3-small">{{$cost->Usu_CodCcu}}</td>
                                <td class="w3-small">{{$cost->Usu_DesCcu}}</td>
                                <td class="w3-small">
                                @php
                                    switch ($cost->Usu_CodCar){
                                        case 1:
                                            echo "Gerente do contrato";
                                        break;
                                        case 2:
                                            echo "Analista do contrato";
                                        break;
                                        case 5:
                                            echo "Gerente de operação";
                                        break;
                                        case 9:
                                            echo "Ponto Focal";
                                        break;
                                    }

                                @endphp
                                </td>
                                <td class="w3-small">{{$cost->Usu_NomCto}}</td>
                                <td class="w3-small">
                                    @php
                                        $data = new \Carbon\Carbon($cost->Usu_DatBas);
                                        echo $data->format('d/m/Y')

                                    @endphp
                                </td>
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