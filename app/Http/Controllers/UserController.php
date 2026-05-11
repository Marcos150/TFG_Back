<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();
        return response()->json($user->toResource());
    }

    public function destroy(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->delete();

        return response()->json(null, 204);
    }
}
