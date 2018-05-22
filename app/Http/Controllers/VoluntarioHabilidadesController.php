<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoluntarioHabilidades;
use App\Models\VoluntarioOpcoes;
use App\Models\Voluntario;
use App\Http\Controllers\BaseController;
use Validator;

/**
 * @author Gabriel Nascimmento <gabrielnsilva2@gmail.com>
 */
class VoluntarioHabilidadesController extends BaseController
{
    /**
     * @SWG\Get(
     *      path="/voluntariohabilidades",
     *      operationId="index",
     *      summary="Retorna todos os voluntario habilidades",
     *      tags={"Voluntario Habilidades"},
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="Informação recuperada com sucesso",
     *      )
     * )
     */
     public function index()
     {
         $voluntariohabilidades = VoluntarioHabilidades::all();
         return $this->sendResponse($voluntariohabilidades->toArray(), 'Informação recuperada com sucesso');
     }

     /**
     * @SWG\Get(
     *      path="/voluntariohabilidades/{id}",
     *      operationId="show",
     *      summary="Procurar um voluntario habilidade pelo ID",
     *      tags={"Voluntario Habilidades"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do voluntario habilidade",
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
         $voluntariohabilidades = VoluntarioHabilidades::find($id);

         if (is_null($voluntariohabilidades)) {
             return $this->sendError('Informação não encontrada', 404);
         }

         return $this->sendResponse($voluntariohabilidades->toArray(), 'Informação recuperada com sucesso');
     }

     /**
     * @SWG\Get(
     *      path="/voluntariohabilidades/user/{id}",
     *      operationId="user",
     *      summary="Procurar voluntario habilidade pelo ID do voluntario",
     *      tags={"Voluntario Habilidades"},
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
     public function voluntario($id)
     {
         $voluntariohabilidades = VoluntarioHabilidades::where('tb_voluntario_id', $id);

         if (is_null($voluntariohabilidades)) {
             return $this->sendError('Informação não encontrada', 404);
         }

         return $this->sendResponse($voluntariohabilidades->toArray(), 'Informação recuperada com sucesso');
     }


     /**
      * @SWG\Post(
      *     path="/voluntariohabilidades",
      *     operationId="store",
      *     summary="Adiciona um novo voluntario habilidade",
      *     tags={"Voluntario Habilidades"},
      *     produces={"application/json"},
      *     @SWG\Parameter(
      *         name="body",
      *         in="body",
      *         required=true,
      *         @SWG\Definition(
      *              @SWG\Property(property="tb_voluntario_id", type="integer"),
      *              @SWG\Property(
      *                property="opcoes_id",
      *                    type="array",
      *                    @SWG\Items(
      *                        type="object",
      *                        @SWG\Property(property="tb_habilidade_id", type="integer"),
      *                    ),
      *                ),
      *             ),
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

         $voluntario_id = $request->tb_voluntario_id;
         $opcoes = $request->opcoes_id;

         // Validacao

         $input = $request->all();

         $rules = [
           'tb_voluntario_id' => 'required|numeric',
           'opcoes_id'        => 'required|array',
         ];

         $validator = Validator::make($input, $rules);
         if ($validator->fails()) {
             return response()->json(['success'=> false, 'error'=> $validator->messages()]);
         }

         // Armazenamento
         foreach ($opcoes as $op) {
             $voluntariohabilidades = new VoluntarioHabilidades;

             $voluntariohabilidades['tb_habilidade_id'] = $op['tb_habilidade_id'];
             $voluntariohabilidades['tb_voluntario_id'] = $voluntario_id;

             $voluntariohabilidades->save();
         }

         return $this->sendResponse($request->toArray(), 'Informação adicionada com sucesso');
     }
}
