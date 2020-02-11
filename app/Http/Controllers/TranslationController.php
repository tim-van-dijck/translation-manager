<?php

namespace App\Http\Controllers;

use App\Http\Resources\TranslationResource;
use Illuminate\Http\Request;
use App\Repositories\TranslationRepository;

class TranslationController extends Controller
{
    /**
     * @param TranslationRepository $translationRepository
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(TranslationRepository $translationRepository, Request $request)
    {
        $page = $request->get('page');
        $translations = $translationRepository->get($page['number'] ?? 1, $page['size'] ?? 50);
        return TranslationResource::collection($translations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TranslationRepository $translationRepository, Request $request)
    {
        $this->validate($request, [
            'key' => 'required|string|unique:translation_keys,key',
            'languages.*.translation' => 'string'
        ]);

        $translation = $translationRepository->store($request->input('key'), $request->input('languages'));
        return response()->json($translation->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function show(TranslationRepository $translationRepository, string $key)
    {
        return response()->json($translationRepository->find($key));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function update(TranslationRepository $translationRepository, Request $request, string $key)
    {
        $this->validate($request, [
            'key' => 'required|string|regex://',
            'languages.*.translation' => 'string'
        ]);

        return response()->json($translationRepository->update($key, $request->input()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function destroy(TranslationRepository $translationRepository, string $key)
    {
        $translationRepository->destroy($key);
    }

    public function system(string $language)
    {
        $translations = [];

        foreach (['system', 'translation', 'language'] as $category) {
            foreach (trans($category) as $key => $translation) {
                $translations["$category.$key"] = $translation;
            }
        }
        return response()->json($translations);
    }
}
