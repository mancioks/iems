<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{
    public function translate(Request $request)
    {
        $target = $request->input('target');
        $text = $request->input('text');

        if (!$text) {
            $translation = ['translation' => ''];
        } else {
            $translationService = new GoogleTranslate();
            $translationService->setSource();
            $translationService->setTarget($target);

            $translation = ['translation' => $translationService->translate($text)];
        }

        return json_encode($translation);
    }
}
