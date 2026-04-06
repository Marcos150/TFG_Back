<?php

namespace App\Http\Controllers;

use App\Models\SheetMusic;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SheetMusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
       /*  $sheetMusic = DB::table('sheet_musics')
            ->where('id', $id)
            ->first();
         */
        $otherSheetMusic = SheetMusic::find($id);

        return response()->json([
            'id' => $id,
            'title' => 'Example Sheet Music',
            'author' => 'John Doe',
            'tags' => ['Classical', 'Piano'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
