<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *  @SWG\Definition(
 *   definition="Voluntario Habilidades",
 *   type="object",
 *   allOf={
 *       @SWG\Schema(
 *           @SWG\Property(property="tb_voluntario_id", type="integer"),
 *           @SWG\Property(property="tb_habilidade_id", type="integer"),
 *       )
 *   }
 * )
 */
class VoluntarioHabilidades extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'tb_voluntario_id',
        'tb_habilidade_id',
    ];

    protected $guarded = [
        'id',
        'data_criacao',
        'data_atualizacao',
        'data_exclusao'
    ];

    protected $table = 'tb_voluntario_habilidades';
}
