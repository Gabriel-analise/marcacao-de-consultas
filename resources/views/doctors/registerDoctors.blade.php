@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/registerPatients.css') }}">

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cadastro de Médicos') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('doctors.store') }}">
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
                                <input id="nome" type="text" class="form-control" name="nome_medico" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="cpf">{{ __('CRM') }}</label>
                                <input id="cpf" type="text" class="form-control cpf" name="CRM_medico" required>
                            </div>
                            
                            <div class="select">
                                <label for="selectOption">Escolha a especialidade:</label>
                                <select id="selectOption" name="especialidade_medico">
                                    @foreach($specialtys as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar Médico') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection