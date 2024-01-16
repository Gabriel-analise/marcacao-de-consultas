<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

/**
 * Class SpecialtyController
 * @package App\Http\Controllers
 */
class SpecialtyController extends Controller
{
    /**
     * Display a listing of specialties.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /**
         * Retrieve all specialties from the database and pluck their names for a dropdown.
         *
         * @var \Illuminate\Support\Collection $specialtys
         */
        $specialtys = Specialty::pluck('nome_especialidade', 'id_especialidade');

        return view('doctors.registerDoctors', compact('specialtys'));
    }

    /**
     * Show the form for creating a new specialty.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('specialtys.registerSpecialtys');
    }

    /**
     * Store a newly created specialty in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /**
         * Validate the request data for specialty creation.
         */
        $request->validate([
            'nome_especialidade' => 'required|string|max:50|unique:cls_especialidades',
        ]);

        /**
         * Create a new specialty in the database.
         */
        Specialty::create($request->all());

        return redirect()->route('specialtys.register')
            ->with('success', 'Especialidade cadastrada com sucesso!');
    }

    /**
     * Display the specified specialty.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\View\View
     */
    public function show(Specialty $specialty)
    {
        return view('specialtys.show', compact('specialty'));
    }

    /**
     * Show the form for editing the specified specialty.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\View\View
     */
    public function edit(Specialty $specialty)
    {
        return view('specialtys.edit', compact('specialty'));
    }

    /**
     * Update the specified specialty in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Specialty $specialty)
    {
        /**
         * Validate the request data for specialty update.
         */
        $request->validate([
            'nome_especialidade' => 'required|string|max:50|unique:cls_especialidades,nome_especialidade,'.$specialty->id_especialidade,
        ]);

        /**
         * Update the specified specialty in the database.
         */
        $specialty->update($request->all());

        return redirect()->route('specialtys.index')
            ->with('success', 'Especialidade atualizada com sucesso!');
    }

    /**
     * Remove the specified specialty from storage.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Specialty $specialty)
    {
        /**
         * Delete the specified specialty from the database.
         */
        $specialty->delete();

        return redirect()->route('specialtys.index')
            ->with('success', 'Especialidade excluída com sucesso!');
    }
}
