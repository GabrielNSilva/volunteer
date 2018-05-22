<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voluntario;
use App\Http\Controllers\BaseController;
use Validator;

/**
 * @author Gabriel Nascimmento <gabrielnsilva2@gmail.com>
 */
class DBController extends BaseController
{
    /**
     * @SWG\Get(
     *      path="/db/clean",
     *      operationId="clean",
     *      summary="Limpa todos os registros do BD",
     *      tags={"Voluntario"},
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="Informação recuperada com sucesso",
     *      )
     * )
     */
     public function clean()
     {
         // $voluntarios = Voluntario::all();
         return $this->sendResponse(null, 'Nada');
     }

}
