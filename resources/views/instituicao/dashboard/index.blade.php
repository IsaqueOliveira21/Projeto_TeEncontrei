@extends('instituicao.template')
@section('titulo')
    DASHBOARD
@endsection

@php
    $migalhas = [
        ['item' => 'DASHBOARD', 'link' => '#'],
];
@endphp

@section('conteudo')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="py-4 text-center">
                            <div class="mb-3">
                                <i class="fa fa-hotel fa-3x text-xinspire"></i>
                            </div>
                            <div class="fs-4 fw-semibold">{{$visitas}} Visitas Realizadas</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="py-4 text-center">
                            <div class="mb-3">
                                <i class="fa fa-users fa-3x text-xsmooth"></i>
                            </div>
                            <div class="fs-4 fw-semibold">{{$colaboradores}} Colaboradores</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="py-4 text-center">
                            <div class="mb-3">
                                <i class="fa fa-house-user fa-3x text-info"></i>
                            </div>
                            <div class="fs-4 fw-semibold">{{$desabrigados}} Desabrigados Cadastrados</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
                    <div id="grafico1">
                    </div>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-content">
                    <div id="grafico2">
                    </div>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-content">
                    <div id="grafico3">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
