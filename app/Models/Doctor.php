<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Doctor
 * @package App\Models
 */
class Doctor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cls_medicos';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_medico';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_medico',
        'especialidade_medico',
        'CRM_medico',
    ];

    /**
     * Get the specialty associated with the doctor.
     */
    public function especialidade()
    {
        return $this->belongsTo(Specialty::class, 'especialidade_medico', 'id_especialidade');
    }
}
