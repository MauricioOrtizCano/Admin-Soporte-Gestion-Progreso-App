<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class userController extends Controller
{
    // Obtener todos los usuarios
    public function getAllUsers() {
        $users = User::all();

        if ($users->isEmpty()) {
            $data = [
                "message" => "No se encontraron usuarios",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            "message" => "Usuarios encontrados",
            "data" => $users,
            "status" => 200
        ];

        return response()->json($data, 200);
    }


    // Obtener los usuarios con paginación
    public function getUserPaginated(Request $request) {
        $limit = $request->query('limit') ? $request->query('limit') : 10;
        $users = User::paginate($limit);

        if ($users->isEmpty()) {
            $data = [
                "message" => "No se encontraron usuarios",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            "message" => "Usuarios encontrados",
            "data" => $users,
            "status" => 200
        ];

        return response()->json($data, 200);
    }


    // Obtener un usuario por ID
    public function getUserById($id) {
        $user = User::find($id);

        if (!$user) {
            $data = [
                "message" => "Usuario no encontrado",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            "message" => "Usuario encontrado",
            "data" => $user,
            "status" => 200
        ];

        return response()->json($data, 200);
    }


    // Crear un usuario
    public function createUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Datos incorrectos",
                "errors" => $validator->errors(),
                "status" => 400
            ];

            return response()->json($data, 400);
        }

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        $data = [
            "message" => "Usuario creado",
            "data" => $user,
            "status" => 201
        ];

        return response()->json($data, 201);
    }


    // Actualizar un usuario
    public function updateUser(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            $data = [
                "message" => "Usuario no encontrado",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Datos incorrectos",
                "errors" => $validator->errors(),
                "status" => 400
            ];

            return response()->json($data, 400);
        }

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        $data = [
            "message" => "Usuario actualizado",
            "data" => $user,
            "status" => 200
        ];

        return response()->json($data, 200);
    }


    // Eliminar un usuario
    public function deleteUser($id) {
        $user = User::find($id);

        if (!$user) {
            $data = [
                "message" => "Usuario no encontrado",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $user->delete();

        $data = [
            "message" => "Usuario eliminado",
            "status" => 200
        ];

        return response()->json($data, 200);
    }


    // Actualizar un usuario parcialmente
    public function updatePartialUser(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            $data = [
                "message" => "Usuario no encontrado",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'lastname' => 'string',
            'email' => 'email',
            'role' => 'string',
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Datos incorrectos",
                "errors" => $validator->errors(),
                "status" => 400
            ];

            return response()->json($data, 400);
        }

        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->lastname) {
            $user->lastname = $request->lastname;
        }
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->role) {
            $user->role = $request->role;
        }

        $user->save();

        $data = [
            "message" => "Usuario actualizado parcialmente",
            "data" => $user,
            "status" => 200
        ];

        return response()->json($data, 200);
    }

    // Obtener los casos de soporte de un usuario
    public function getUserSupportCases($id) {
        $user = User::find($id);

        if (!$user) {
            $data = [
                "message" => "Usuario no encontrado",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $cases = $user->role === 'agent' 
        ? $user->assignedCases()->with(['requester', 'comments'])->get()
        : $user->requestedCases()->with(['agent', 'comments'])->get();

        if ($cases->isEmpty()) {
            $data = [
                "message" => "No se encontraron casos de soporte para este usuario",
                "status" => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            "message" => "Casos de soporte encontrados",
            "data" => $cases,
            "status" => 200
        ];

        return response()->json($data, 200);
    }
}
