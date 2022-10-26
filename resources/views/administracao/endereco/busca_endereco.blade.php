@extends('administracao.template')
@section('titulo', 'BUSCAR ENDEREÇO')
@php
    $migalhas = [
        ['item' => 'ENDEREÇO', 'link' => '#'],
        ['item' => 'BUSCAR ENDEREÇO', 'link' => '#'],
];
@endphp

@section('conteudo')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <form method="POST" action="{{route('endereco.buscarCEP')}}" enctype="application/x-www-form-urlencoded">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label" for="cep">DIGITE O CEP PARA BUSCAR</label>
                        <div class="input-group">
                            <input type="search" class="form-control" id="cep" name="cep" required placeholder="00000-000">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

