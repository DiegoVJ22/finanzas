<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Http\Request;
use OpenAI\Client;
use Illuminate\Support\Facades\Log; // Importar la clase Log

class ChatGPTController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = \OpenAI::factory()
        ->withApiKey(env('OPENAI_API_KEY'))
        ->withHttpClient(new GuzzleHttpClient(['verify' => storage_path('cacert.pem'), ]))
        ->make();
    }

    public function askGPT(Request $request)
    {
        try {
            $query = $request->input('query');

            $gptQuery = "Interpreta estos ratios financieros, que sea ratio por ratio:\n\n";
            $gptQuery .= $query;

            Log::info('Consulta construida: ' . $gptQuery);

            $response = $this->client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $gptQuery],
                ],
            ]);

            $message = $response->choices[0]->message->content;

            Log::info('Respuesta recibida: ' . $message);

            return response()->json([
                'response' => $message,
            ]);
        } catch (\Exception $e) {
            Log::error('Error al consultar GPT: ' . $e->getMessage());
            return response()->json([
                'response' => 'Error: ' . $e->getMessage(), // Mostrar el mensaje de error directamente
            ], 500);
        }
    }

}
