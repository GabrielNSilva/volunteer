<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *  @SWG\Definition(
 *   definition="Habilidade",
 *   type="object",
 *   allOf={
 *       @SWG\Schema(
 *           @SWG\Property(property="descricao", type="string"),
 *           @SWG\Property(property="ativo", type="boolean"),
 *       )
 *   }
 * )
 */
class Habilidade extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'descricao',
        'ativo',
    ];

    protected $guarded = [
        'id',
        'data_criacao',
        'data_atualizacao',
        'data_exclusao'
    ];

    protected $table = 'tb_habilidade';
}
