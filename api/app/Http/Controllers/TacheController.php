<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacheRegisterRequest;
use App\Http\Resources\TacheResource;
use App\Models\Tache;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class TacheController extends Controller
{
    public function index(): JsonResource
    {
        return TacheResource::collection(Tache::all());
    }

    public function store(TeacheRegisterRequest $request): JsonResponse
    {
        $data = $request->all();
        try {
            Tache::create($data);
        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => "query error"
            ];
            return response($response, 400);
        }
        return response()->json($data, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->all();
        try {
            $tache = Tache::find($id);
            $tache->update($data);
        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => 'update query error'
            ];
            return response($response, 400);
        }
        return response()->json($tache, 200);
    }

    public function delete($id): JsonResponse
    {
        try {
            $tache = Tache::find($id);
            $tache->delete();
        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => 'delete query error'
            ];
            return response($response, 400);
        }
        return response()->json($tache, 200);
    }
}
