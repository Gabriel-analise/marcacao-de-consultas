<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Patient
 * @package App\Models
 */
class Patient extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cls_pacientes';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_paciente',
        'cpf_paciente',
        'email_paciente',
        'cep_paciente',
        'endereco_paciente',
        'numero_paciente',
        'nome_responsavel',
        'cpf_responsavel',
        'data_nascimento',
        'data_cadastro',
    ];
}
