<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Class ConsultationController
 * @package App\Http\Controllers
 */
class ConsultationController extends Controller
{
    /**
     * Display a listing of the consultations.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /**
         * Retrieve all consultations from the database.
         *
         * @var \Illuminate\Database\Eloquent\Collection $consultas
         */
        $consultas = Consultation::all();

        return view('consultas.index', compact('consultas'));
    }

    /**
     * Display the index page and create page with necessary data for consultations.
     *
     * @return \Illuminate\View\View
     */
    public function indexAndCreate()
    {
        /**
         * Retrieve all consultations from the database.
         *
         * @var \Illuminate\Database\Eloquent\Collection $consultations
         */
        $consultations = Consultation::all();

        /**
         * Retrieve all patients from the database and pluck their names for a dropdown.
         *
         * @var \Illuminate\Support\Collection $patients
         */
        $patients = Patient::pluck('nome_paciente', 'id_paciente', 'data_nascimento');

        /**
         * Retrieve all doctors from the database and pluck their names for a dropdown.
         *
         * @var \Illuminate\Support\Collection $doctors
         */
        $doctors = Doctor::pluck('nome_medico', 'id_medico');

        return view('consultations.registerConsultations', compact('consultations', 'patients', 'doctors'));
    }

    /**
     * Show the form for creating a new consultation.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('consultation.registerConsultation');
    }

    /**
     * Store a newly created consultation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /**
         * Get the current date and time.
         *
         * @var \Illuminate\Support\Carbon $dataDeHoje
         */
        $dataDeHoje = Carbon::now();

        /**
         * Validate the request data for consultation creation.
         */
        $request->validate([
            'paciente' => 'required|exists:cls_pacientes,id_paciente',
            'medico' => 'required|exists:cls_medicos,id_medico',
            'data_consulta' => 'date',
            'data_agendamento' => 'date',
        ]);

        /**
         * Create a new consultation in the database.
         */
        Consultation::create([
            'paciente' => $request->paciente,
            'medico' => $request->medico,
            'data_consulta' => $request->data_consulta,
            'data_agendamento' => $dataDeHoje->toDateTimeString(),
        ]);

        return redirect()->route('consultations.indexAndCreate')
            ->with('success', 'Consulta cadastrada com sucesso!');
    }

    /**
     * Display the specified consultation.
     *
     * @param  \App\Models\Consultation  $consulta
     * @return \Illuminate\View\View
     */
    public function show(Consultation $consulta)
    {
        return view('consultas.show', compact('consulta'));
    }

    /**
     * Show the form for editing the specified consultation.
     *
     * @param  \App\Models\Consultation  $consulta
     * @return \Illuminate\View\View
     */
    public function edit(Consultation $consulta)
    {
        return view('consultas.edit', compact('consulta'));
    }

    /**
     * Update the specified consultation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consulta
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Consultation $consulta)
    {
        /**
         * Validate the request data for consultation update.
         */
        $request->validate([
            'paciente' => 'required|exists:cls_pacientes,id_paciente',
            'medico' => 'required|exists:cls_medicos,id_medico',
            'data_consulta' => 'required|date',
            'data_agendamento' => 'required|date',
        ]);

        /**
         * Update the specified consultation in the database.
         */
        $consulta->update($request->all());

        return redirect()->route('consultas.index')
            ->with('success', 'Consulta atualizada com sucesso!');
    }

    /**
     * Remove the specified consultation from storage.
     *
     * @param  \App\Models\Consultation  $consulta
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Consultation $consulta)
    {
        /**
         * Delete the specified consultation from the database.
         */
        $consulta->delete();

        return redirect()->route('consultas.index')
            ->with('success', 'Consulta excluída com sucesso!');
    }
}
