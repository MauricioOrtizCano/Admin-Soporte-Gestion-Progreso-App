<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SupportCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class supportcaseController extends Controller
{   
    // Obtener todos los casos de soporte
    public function getAllSupportCases() {
        $supportcases = SupportCase::all();

        if ($supportcases->isEmpty()) {
            $data = [
                "message" => "No se encontraron Casos de Soporte",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            "message" => "Casos de Soporte encontrados",
            "data" => $supportcases,
            "status" => 200
        ];

        return response()->json($data, 200);
    }


    // Obtener los casos de soporte paginados
    public function getSupportCasesPaginated(Request $request) {
        $limit = $request->query('limit') ? $request->query('limit') : 5;
        $supportcases = SupportCase::paginate($limit);

        if ($supportcases->isEmpty()) {
            $data = [
                "message" => "No se encontraron Casos de Soporte",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            "message" => "Casos de Soporte encontrados",
            "data" => $supportcases,
            "status" => 200
        ];

        return response()->json($data, 200);
    }


    // Obtener un solo caso de soporte
    public function getOneSupportCase($id) {
        $supportcases = SupportCase::find($id);

        if (!$supportcases) {
            $data = [
                "message" => "Usuario no encontrado",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            "message" => "Usuario encontrado",
            "data" => $supportcases,
            "status" => 200
        ];

        return response()->json($data, 200);
    }


    // Crear caso de soporte
    public function createSupportCase(Request $request) {
        $validator = Validator::make($request->all(), [
            'requester_id' => 'required|exists:users,id',
            'agent_id' => 'exists:users,id|nullable',
            'status' => 'sometimes|string',
            'entry_date' => 'required|date',
            'closed_at' => 'sometimes|date|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => 422
            ], 422);
        }

        $supportcase = SupportCase::create([
            'requester_id' => $request->requester_id,
            'agent_id' => $request->agent_id,
            'status' => $request->status,
            'entry_date' => $request->entry_date,
            'closed_at' => $request->closed_at,
        ]);

        $data = [
            'message' => 'Support case created successfully',
            'data' => $supportcase,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    // Actualizar un casos de soporte parcialmente
    public function updatePartialSupportCase(Request $request, $id) {
        $supportcases = SupportCase::find($id);

        if (!$supportcases) {
            $data = [
                "message" => "Usuario no encontrado",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'requester_id' => 'sometimes|exists:users,id',
            'agent_id' => 'sometimes|exists:users,id|nullable',
            'status' => 'sometimes|string',
            'entry_date' => 'sometimes|date',
            'closed_at' => 'sometimes|date|nullable',
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Datos incorrectos",
                "errors" => $validator->errors(),
                "status" => 400
            ];

            return response()->json($data, 400);
        }

        if ($request->requester_id) {
            $supportcases->requester_id = $request->requester_id;
        }
        if ($request->agent_id) {
            $supportcases->agent_id = $request->agent_id;
        }
        if ($request->status) {
            $supportcases->status = $request->status;
        }
        if ($request->entry_date) {
            $supportcases->entry_date = $request->entry_date;
        }
        if ($request->closed_at) {
            $supportcases->closed_at = $request->closed_at;
        }

        $supportcases->save();
        
        $data = [
            'message' => 'Caso de soporte creado exitosamente',
            'data' => $supportcases,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    // Eliminar un caso de soporte
    public function deleteSupportCase($id) {
        $supportcase = SupportCase::find($id);

        if (!$supportcase) {
            $data = [
                "message" => "Usuario no encontrado",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $supportcase->delete();

        $data = [
            "message" => "Caso de soporte eliminado",
            "status" => 200
        ];

        return response()->json($data, 200);
    }
}
