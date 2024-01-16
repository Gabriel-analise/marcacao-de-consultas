<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Consultation
 * @package App\Models
 */
class Consultation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cls_consultas';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_consulta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paciente',
        'medico',
        'data_consulta',
        'data_agendamento',
    ];

    /**
     * Get the patient associated with the consultation.
     */
    public function paciente()
    {
        return $this->belongsTo(ClsPaciente::class, 'paciente', 'id_paciente');
    }

    /**
     * Get the doctor associated with the consultation.
     */
    public function medico()
    {
        return $this->belongsTo(ClsMedico::class, 'medico', 'id_medico');
    }
}
