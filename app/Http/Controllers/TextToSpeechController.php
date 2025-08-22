<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TextToSpeechController extends Controller
{
    public function showForm()
    {
        return view('text_to_speech.form');
    }

    public function convertText(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:2500'
        ]);

        $text = $request->input('text');
        $apiKey = env('DEEPGRAM_API_KEY');

        try {
            
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'audio/mpeg',
            ])->post("https://api.deepgram.com/v1/speak?model=aura-asteria-en", [
                'text' => $text,
            ]);

            if ($response->successful() && $response->body()) {
                $audioContent = base64_encode($response->body());

                return view('text_to_speech.form', [
                    'audio' => $audioContent,
                    'original_text' => $text,
                ]);
            } else {
                return redirect()->back()->withErrors(['api_error' => 'A API retornou um erro. Chave Inválida']);
            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['api_error' => 'Ocorreu um erro: ' . $e->getMessage()]);
        }
    }
}