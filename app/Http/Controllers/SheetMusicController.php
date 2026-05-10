<?php

namespace App\Http\Controllers;

use App\Models\SheetMusic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class SheetMusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sheetMusic = $request->user()->sheetMusic()->with('tags')->get();

        return response()->json($sheetMusic->toResourceCollection());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $request->file('file')->store('files');
        $measures = json_decode($request->input('measures'), true);
        $sortedMeasures = collect($measures)->sort(function ($a, $b) {
            $tolerance = 0.05;

            if (abs($a['top'] - $b['top']) > $tolerance) {
                return $a['top'] <=> $b['top'];
            }

            return $a['left'] <=> $b['left'];
        })->values()->all();
        $sheetMusic = SheetMusic::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'file_path' => $path,
            'measures' => $sortedMeasures,
            'user_id' => $request->user()->id,
        ]);

        if ($request->has('tags')) {
            $tagsData = json_decode($request->tags, true);

            if (is_array($tagsData)) {
                $tagIds = collect($tagsData)->pluck('id')->toArray();
                $sheetMusic->tags()->sync($tagIds);
            }
        }

        return response()->json($sheetMusic, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $sheetMusic = SheetMusic::with('tags')->find($id);
        Gate::authorize('view', $sheetMusic);

        return response()->json($sheetMusic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sheetMusic = SheetMusic::find($id);
        Gate::authorize('update', $sheetMusic);

        $measures = $request->input('measures');

        $sortedMeasures = collect($measures)->sort(function ($a, $b) {
            $tolerance = 0.05;

            if (abs($a['top'] - $b['top']) > $tolerance) {
                return $a['top'] <=> $b['top'];
            }

            return $a['left'] <=> $b['left'];
        })->values()->all();
        $sheetMusic->update(array_merge($request->all(), ['measures' => $sortedMeasures]));

        return response()->json($sheetMusic);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sheetMusic = SheetMusic::find($id);
        Gate::authorize('delete', $sheetMusic);
        SheetMusic::destroy($id);

        return response()->json(null, 204);
    }

    public function getFile(string $id)
    {
        $sheetMusic = SheetMusic::find($id);
        Gate::authorize('view', $sheetMusic);

        $file = Storage::get($sheetMusic->file_path);

        $contentType = Storage::mimeType($sheetMusic->file_path);

        return response($file, 200)->header('Content-Type', $contentType);
    }
}
