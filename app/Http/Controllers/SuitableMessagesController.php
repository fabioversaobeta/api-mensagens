<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Services\SuitableMessagesService;

class SuitableMessagesController extends Controller
{
    private $suitableService;

    public function __construct(SuitableMessagesService $suitableService)
    {
        $this->suitableService = $suitableService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Verifica se arquivo existe
        if(!$request->hasFile('file')){
            return $this->formatReturn(true, [], 400, 'File not found');
        }

        // Transforma arquivo em um array onde cada linha é uma string
        $fileContent = File::get($request->file('file'));
        $file = str_getcsv($fileContent, "\n");

        // Chama serviço que irá validar cada mensagem e retornar o Broker
        $suitableMessages = $this->suitableService->suitables($file);

        // retorna JSON com os dados
        return $this->cleanReturn($suitableMessages, 200);
    }
}
