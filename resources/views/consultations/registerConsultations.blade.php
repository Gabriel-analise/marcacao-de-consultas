@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/registerPatients.css') }}">

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Agendamento de consultas') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('consultations.store') }}">
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

                            <div class="select">
                                <label for="selectOption">Escolha o paciente:</label>
                                <select id="selectOption" name="paciente">
                                    @foreach($patients as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="select">
                                <label for="selectOption2">Escolha o médico:</label>
                                <select id="selectOption2" name="medico">
                                    @foreach($doctors as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="numero">{{ __('Data da consulta') }}</label>
                                <input id="dataConsulta" type="date" class="form-control" name="data_consulta" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Agendar consulta') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection