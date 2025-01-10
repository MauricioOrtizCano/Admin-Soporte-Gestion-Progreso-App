<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class commentController extends Controller
{
    public function getAllComments()
    {
        $comments = Comment::with(['user', 'supportCase'])->get();
        
        if ($comments->isEmpty()) {
            return response()->json([
                "message" => "No se encontraron comentarios",
                "status" => 404
            ], 404);
        }

        return response()->json([
            "message" => "Comentarios encontrados",
            "data" => $comments,
            "status" => 200
        ], 200);
    }

    public function getCommentsPaginated(Request $request)
    {
        $limit = $request->query('limit', 10);
        $comments = Comment::with(['user', 'supportCase'])->paginate($limit);

        if ($comments->isEmpty()) {
            return response()->json([
                "message" => "No se encontraron comentarios",
                "status" => 404
            ], 404);
        }

        return response()->json([
            "message" => "Comentarios encontrados",
            "data" => $comments,
            "status" => 200
        ], 200);
    }

    public function getOneComment($id)
    {
        $comment = Comment::with(['user', 'supportCase'])->find($id);

        if (!$comment) {
            return response()->json([
                "message" => "Comentario no encontrado",
                "status" => 404
            ], 404);
        }

        return response()->json([
            "message" => "Comentario encontrado",
            "data" => $comment,
            "status" => 200
        ], 200);
    }

    public function createComment(Request $request) {
        $validator = Validator::make($request->all(), [
            'support_case_id' => 'required|exists:supportcases,id',
            'agent_id' => 'required|exists:users,id',
            'comments' => 'required|array',
            'comments.*.text' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 422
            ], 422);
        }

        $commentData = array_map(function($comment) {
            return [
                'text' => $comment['text'],
                'timestamp' => now()->toDateTimeString()
            ];
        }, $request->comments);

        $comment = Comment::create([
            'support_case_id' => $request->support_case_id,
            'agent_id' => $request->agent_id,
            'comments' => $commentData,
        ]);

        return response()->json([
            "message" => "Comentario creado",
            "data" => $comment,
            "status" => 201
        ], 201);
    }

    // public function createComment(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'support_case_id' => 'required|exists:supportcases,id',
    //         'agent_id' => 'required|exists:users,id',
    //         'comments' => 'required|array',
    //         'comments.text' => 'required|string|max:1000',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Error en la validación de datos',
    //             'errors' => $validator->errors(),
    //             'status' => 422
    //         ], 422);
    //     }

    //     $commentData = array_map(function($text) {
    //         return [
    //             'text' => $text,
    //             'timestamp' => now()->toDateTimeString()
    //         ];
    //     }, $request->comments);
    
    //     $comment = Comment::create([
    //         'support_case_id' => $request->support_case_id,
    //         'agent_id' => $request->agent_id,
    //         'comments' => $commentData,
    //     ]);
    
    //     return response()->json([
    //         "message" => "Comentario creado",
    //         "data" => $comment,
    //         "status" => 201
    //     ], 201);
    // }

    public function updateComment(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                "message" => "Comentario no encontrado",
                "status" => 404
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'comments' => 'required|array',
            'comments.text' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 422
            ], 422);
        }

        $existingComments = $comment->comments ?? []; // Obtenermos los comentarios existentes
        $newComment = [
            'text' => $request->comments['text'],
            'timestamp' => now()->toDateTimeString()
        ];

        $updatedComments = array_merge($existingComments, [$newComment]);

        $comment->comments = $updatedComments;
        $comment->save();

        return response()->json([
            "message" => "Comentario actualizado",
            "data" => $comment,
            "status" => 200
        ], 200);
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                "message" => "Comentario no encontrado",
                "status" => 404
            ], 404);
        }

        $comment->delete();

        return response()->json([
            "message" => "Comentario eliminado",
            "status" => 200
        ], 200);
    }

}
