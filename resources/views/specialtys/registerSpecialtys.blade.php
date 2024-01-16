@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/registerPatients.css') }}">
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cadastro de Especialidades') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('specialtys.store') }}">
                            @csrf

                            @if($errors->any())
                                <div class="form-group">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="nome">{{ __('Nome') }}</label>
                                <input id="nome" type="text" class="form-control" name="nome_especialidade" required autofocus>
                            </div>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar Especialidade') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection