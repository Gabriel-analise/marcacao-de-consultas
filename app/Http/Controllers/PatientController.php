<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

/**
 * Class PatientController
 * @package App\Http\Controllers
 */
class PatientController extends Controller
{
    /**
     * Show the form for creating a new patient.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('patients.registerPatients');
    }

    /**
     * Store a newly created patient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /**
         * Validate the request data for patient creation.
         *
         * @var \Illuminate\Validation\Validator $validator
         */
        $validator = Validator::make($request->all(), [
            'nome_paciente' => 'required|string|max:50',
            'cpf_paciente' => 'required|unique:cls_pacientes',
            'email_paciente' => 'required|email|unique:cls_pacientes',
            'cep_paciente' => 'required',
            'endereco_paciente' => 'required|string|max:255',
            'numero_paciente' => 'required',
            'data_nascimento' => 'date',
            'nome_responsavel' => 'nullable|string|max:50',
            'cpf_responsavel' => 'nullable|unique:cls_pacientes',
        ],  [
            'nome_paciente.required' => 'The patient name field is required.',
            'email_paciente.required' => 'The patient email field is required.',
            'endereco_paciente.required' => 'The patient address field is required.',
            'numero_paciente.required' => 'The patient number field is required.',
            'cpf_paciente.unique' => 'A patient with this CPF already exists.',
            'email_paciente.unique' => 'A patient with this email already exists.',
        ]);

        if ($validator->fails()) {
            return redirect('/registerPatients')
                        ->withErrors($validator)
                        ->withInput();
        }

        /**
         * Get the current date and time.
         *
         * @var \Illuminate\Support\Carbon $currentDate
         */
        $currentDate = Carbon::now();

        /**
         * Create a new patient in the database.
         */
        Patient::create([
            'nome_paciente' => $request->nome_paciente,
            'cpf_paciente' => $request->cpf_paciente,
            'email_paciente' => $request->email_paciente,
            'cep_paciente' => $request->cep_paciente,
            'endereco_paciente' => $request->endereco_paciente,
            'numero_paciente' => $request->numero_paciente,
            'nome_responsavel' => $request->nome_responsavel,
            'cpf_responsavel' => $request->cpf_responsavel,
            'data_nascimento' => $request->data_nascimento,
            'data_cadastro' => $currentDate->toDateTimeString(),
        ]);

        return redirect()->route('patients.register')->with('success', 'Paciente cadastrado com sucesso!');
    }
}
