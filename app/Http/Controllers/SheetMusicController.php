<?php

namespace App\Http\Controllers;

use App\Models\SheetMusic;
use Illuminate\Http\Request;

class SheetMusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sheetMusic = SheetMusic::all()->load('tags');

        return response()->json($sheetMusic);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $request->file('file')->store('files');
        $sheetMusic = SheetMusic::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'file_path' => $path,
        ]);

        return response()->json($sheetMusic, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        $sheetMusic = SheetMusic::find($id)->load('tags');

        return response()->json($sheetMusic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sheetMusic = SheetMusic::find($id);
        $sheetMusic->update($request->all());

        return response()->json($sheetMusic);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SheetMusic::destroy($id);

        return response()->json(null, 204);
    }
}
