<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habilidade;
use App\Http\Controllers\BaseController;
use Validator;

/**
 * @author Gabriel Nascimmento <gabrielnsilva2@gmail.com>
 */
class HabilidadeController extends BaseController
{
    /**
     * @SWG\Get(
     *      path="/habilidade",
     *      operationId="index",
     *      summary="Retorna todas as habilidade",
     *      tags={"Desperta Opcoes"},
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="Informação recuperada com sucesso",
     *      )
     * )
     */
     public function index()
     {
         $habilidades = Habilidade::all();
         return $this->sendResponse($habilidades->toArray(), 'Informação recuperada com sucesso');
     }

     /**
     * @SWG\Get(
     *      path="/habilidade/{id}",
     *      operationId="show",
     *      summary="Procurar uma habilidade pelo ID",
     *      tags={"Desperta Opcoes"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da habilidade",
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
         $habilidade = Habilidade::find($id);

         if (is_null($habilidade)) {
             return $this->sendError('Informação não encontrada', 404);
         }

         return $this->sendResponse($habilidade->toArray(), 'Informação recuperada com sucesso');
     }


     /**
      * @SWG\Post(
      *     path="/habilidade",
      *     operationId="store",
      *     summary="Adiciona um novo habilidade",
      *     tags={"Desperta Opcoes"},
      *     produces={"application/json"},
      *     @SWG\Parameter(
      *         name="body",
      *         in="body",
      *         required=true,
      *         @SWG\Definition(
      *              @SWG\Property(property="descricao", type="string"),
      *              @SWG\Property(property="ativo", type="boolean"),
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
           'descricao'  => 'required|string|max:199',
           'ativo'      => 'boolean'
         ];
         $validator = Validator::make($input, $rules);
         if ($validator->fails()) {
             return response()->json(['success'=> false, 'error'=> $validator->messages()]);
         }

         $habilidade = new Habilidade;
         $habilidade['descricao'] = $request->descricao;
         $habilidade['ativo'] = $request->ativo;
         if (is_null($habilidade['ativo'])) {
             $habilidade['ativo'] = true;
         }
         $habilidade->save();

         return $this->sendResponse($habilidade->toArray(), 'Informação adicionada com sucesso');
     }

     /**
      * @SWG\Put(
      *     path="/habilidade/{id}",
      *     operationId="update",
      *     summary="Atualiza um habilidade existente",
      *     tags={"Desperta Opcoes"},
      *     produces={"application/json"},
      *     @SWG\Parameter(
      *         name="id",
      *         in="path",
      *         required=true,
      *         description="ID do desperta opcao",
      *         type="integer"
      *     ),
      *     @SWG\Parameter(
      *         name="body",
      *         in="body",
      *         required=true,
      *         @SWG\Definition(
      *              @SWG\Property(property="descricao", type="string"),
      *              @SWG\Property(property="ativo", type="boolean"),
      *         )
      *     ),
      *     @SWG\Response(
      *         response=200,
      *         description="Informação atualizada com sucesso",
      *     ),
      *     @SWG\Response(
      *         response=404,
      *         description="Informação não encontrada",
      *     ),
      *     @SWG\Response(
      *         response=400,
      *         description="Erro na validação dos dados",
      *     )
      * )
      */
     public function update(Request $request, $id)
     {
         $habilidade = Habilidade::find($id);

         if (is_null($habilidade)) {
             return $this->sendError('Informação não encontrada', 404);
         }

         $input = $request->all();
         // dd($input);

         $rules = [
             'descricao'  => 'string|max:199',
             'ativo'      => 'boolean'
         ];
         $validator = Validator::make($input, $rules);
         if ($validator->fails()) {
             return response()->json(['success'=> false, 'error'=> $validator->messages()]);
         }

         // dd($habilidade);
         $habilidade->fill($input)->save();

         return $this->sendResponse($habilidade->toArray(), 'Informação atualizada com sucesso');
     }

     /**
      * @SWG\Delete(
      *     path="/habilidade/{id}",
      *     operationId="destroy",
      *     summary="Exclui um desperta opcao",
      *     tags={"Desperta Opcoes"},
      *     produces={"application/json"},
      *     @SWG\Parameter(
      *         name="id",
      *         in="path",
      *         required=true,
      *         description="ID do desperta opcao",
      *         type="integer"
      *     ),
      *     @SWG\Response(
      *         response=200,
      *         description="Informação excluída com sucesso",
      *     ),
      *     @SWG\Response(
      *         response=404,
      *         description="Informação não encontrada",
      *     )
      * )
      */
     public function destroy($id)
     {
         $habilidade  = Habilidade::find($id);

         if (is_null($habilidade)) {
             return $this->sendError('Informação não encontrada', 404);
         }

         $habilidade->delete();

         return $this->sendResponse(null, 'Informação excluída com sucesso');
     }
}
