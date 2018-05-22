<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voluntario;
use App\Http\Controllers\BaseController;
use Validator;

/**
 * @author Gabriel Nascimmento <gabrielnsilva2@gmail.com>
 */
class VoluntarioController extends BaseController
{
    /**
     * @SWG\Get(
     *      path="/voluntario",
     *      operationId="index",
     *      summary="Retorna todos os voluntario",
     *      tags={"Voluntario"},
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="Informação recuperada com sucesso",
     *      )
     * )
     */
     public function index()
     {
         $voluntarios = Voluntario::all();
         return $this->sendResponse($voluntarios->toArray(), 'Informação recuperada com sucesso');
     }

     /**
     * @SWG\Get(
     *      path="/voluntario/{id}",
     *      operationId="show",
     *      summary="Procurar um voluntario pelo ID",
     *      tags={"Voluntario"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do voluntario",
     *         type="integer"
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="Informação recuperada com sucesso",
     *      ),
     *      @SWG\Response(
     *         response=404,
     *         description="Informação não encontrada",
     *      )
     * )
     */
     public function show($id)
     {
         $voluntario = Voluntario::find($id);

         if (is_null($voluntario)) {
             return $this->sendError('Informação não encontrada', 404);
         }

         return $this->sendResponse($voluntario->toArray(), 'Informação recuperada com sucesso');
     }


     /**
      * @SWG\Post(
      *     path="/voluntario",
      *     operationId="store",
      *     summary="Adiciona um novo voluntario",
      *     tags={"Voluntario"},
      *     produces={"application/json"},
      *     @SWG\Parameter(
      *         name="body",
      *         in="body",
      *         required=true,
      *         @SWG\Definition(
      *              @SWG\Property(property="nome", type="string"),
      *              @SWG\Property(property="sobrenome", type="string"),
      *              @SWG\Property(property="email", type="string"),
      *              @SWG\Property(property="genero", type="integer"),
      *              @SWG\Property(property="cidade", type="string"),
      *              @SWG\Property(property="estado", type="string"),
      *         )
      *     ),
      *     @SWG\Response(
      *         response=200,
      *         description="Informação adicionada com sucesso",
      *     ),
      *     @SWG\Response(
      *         response=400,
      *         description="Erro na validação dos dados",
      *     )
      * )
      */
     public function store(Request $request)
     {
         $input = $request->all();

         $rules = [
           'nome'           => 'required|string|max:119',
           'sobrenome'      => 'required|string|max:119',
           'email'          => 'required|email|max:199',
           'genero'         => 'required|integer|max:3',
           'cidade'         => 'required|string|max:254',
           'estado'         => 'required|string|max:254',
         ];
         $validator = Validator::make($input, $rules);
         if ($validator->fails()) {
             return response()->json(['success'=> false, 'error'=> $validator->messages()]);
         }

         $voluntario = Voluntario::create($input);

         return $this->sendResponse($voluntario->toArray(), 'Informação adicionada com sucesso');
     }
}
