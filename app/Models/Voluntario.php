<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *  @SWG\Definition(
 *   definition="Voluntario",
 *   type="object",
 *   allOf={
 *       @SWG\Schema(
 *           @SWG\Property(property="id", type="integer"),
 *           @SWG\Property(property="nome", type="string"),
 *           @SWG\Property(property="sobrenome", type="string"),
 *           @SWG\Property(property="email", type="string"),
 *           @SWG\Property(property="genero", type="integer"),
 *           @SWG\Property(property="cidade", type="string"),
 *           @SWG\Property(property="estado", type="string"),
 *           @SWG\Property(property="habilidades", type="string"),
 *           @SWG\Property(property="data_criacao", type="string"),
 *           @SWG\Property(property="data_atualizacao", type="string"),
 *           @SWG\Property(property="data_exclusao", type="string"),
 *       )
 *   }
 * )
 */
class Voluntario extends BaseModel
{
    use SoftDeletes;
    
    protected $fillable = [
        'nome',
        'sobrenome',
        'email',
        'genero',
        'cidade',
        'estado',
        'habilidades',
    ];

    protected $guarded = [
        'id',
        'data_criacao',
        'data_atualizacao',
        'data_exclusao'
    ];

    protected $table = 'tb_voluntario';
}
