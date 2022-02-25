@extends('layouts.app')

@section('title')
    <h1>Cadastro de {{ $tipo}}</h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('empresas.index')}}">Listagem de {{ $tipo }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('empresas.create')}}">Novo {{ $tipo }}</a>
    </li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Dados de Cadastro</h3>
                </div>
                    
                <div class="card-body">
                    <form action="{{ route('empresas.store') }}" method="POST">
                        @include('empresa.form')
                    </form>                     
                   
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
