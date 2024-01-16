<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;

/**
 * Class DoctorController
 * @package App\Http\Controllers
 */
class DoctorController extends Controller
{
    /**
     * Display a listing of doctors.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /**
         * Retrieve all doctors from the database.
         *
         * @var \Illuminate\Database\Eloquent\Collection $doctors
         */
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Display the index page and create page with necessary data for doctors.
     *
     * @return \Illuminate\View\View
     */
    public function indexAndCreate()
    {
        /**
         * Retrieve all doctors from the database.
         *
         * @var \Illuminate\Database\Eloquent\Collection $doctors
         */
        $doctors = Doctor::all();

        /**
         * Retrieve all specialties from the database and pluck their names for a dropdown.
         *
         * @var \Illuminate\Support\Collection $specialtys
         */
        $specialtys = Specialty::pluck('nome_especialidade', 'id_especialidade');

        return view('doctors.registerDoctors', compact('doctors', 'specialtys'));
    }

    /**
     * Show the form for creating a new doctor.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('doctors.registerDoctors');
    }

    /**
     * Store a newly created doctor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /**
         * Validate the request data for doctor creation.
         */
        $request->validate([
            'nome_medico' => 'required|string|max:50',
            'especialidade_medico' => 'required|exists:cls_especialidades,id_especialidade',
            'CRM_medico' => 'required|string|max:8',
        ]);

        /**
         * Create a new doctor in the database.
         */
        Doctor::create($request->all());

        return redirect()->route('doctors.indexAndCreate')
            ->with('success', 'Médico cadastrado com sucesso!');
    }

    /**
     * Display the specified doctor.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\View\View
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified doctor.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\View\View
     */
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified doctor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Doctor $doctor)
    {
        /**
         * Validate the request data for doctor update.
         */
        $request->validate([
            'nome_medico' => 'required|string|max:50',
            'especialidade_medico' => 'required|exists:especialidades,id_especialidade',
            'CRM_medico' => 'required|string|max:8',
        ]);

        /**
         * Update the specified doctor in the database.
         */
        $doctor->update($request->all());

        return redirect()->route('doctors.index')
            ->with('success', 'Médico atualizado com sucesso!');
    }

    /**
     * Remove the specified doctor from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Doctor $doctor)
    {
        /**
         * Delete the specified doctor from the database.
         */
        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Médico excluído com sucesso!');
    }
}
