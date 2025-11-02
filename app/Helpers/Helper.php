<?php

use App\Models\Setting;
use App\Models\Headline;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Session;

function setting()
{
    $setting = Setting::first();
    return $setting;
}

function headline()
{
    $headline = Headline::orderBy('id', 'desc')->where('status', 1)->get()->toArray();
    $data = [];
    foreach ($headline as $key => $value) {
        $data[$key] = $value['name'];
    }

    //array to string
    $data = implode(' | ', $data);
    return $data;
}


function translate($text)
{
    if (empty($text)) {
        return $text;
    }
    $lang = Session::get('locale', 'en');
    if ($lang == 'en') {
        return $text;
    }
    $directory = resource_path('lang/custom');
    $filePath = $directory . '/translations.json';

    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
    if (!file_exists($filePath)) {
        file_put_contents($filePath, json_encode([], JSON_PRETTY_PRINT));
    }
    $translations = json_decode(file_get_contents($filePath), true) ?? [];

    if (isset($translations[$lang][$text])) {
        return $translations[$lang][$text];
    }
    try {
        $translator = new GoogleTranslate();
        $translator->setSource('en');
        $translator->setTarget($lang);
        $translatedText = $translator->translate($text);

        $translations[$lang][$text] = $translatedText;
        file_put_contents($filePath, json_encode($translations, JSON_PRETTY_PRINT));
        return $translatedText;
    } catch (\Exception $e) {
        return $text;
    }
}
