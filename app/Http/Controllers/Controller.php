<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Método trata dados para formato json para retornar via API
     *
     * @param string $status
     * @param array $dados
     * @param integer $codigo
     * @param string $mensagem
     * @return json
     */
    public function formatReturn($status, $data, $code, $message = "")
    {
        return response(
            json_encode([
                'status'=>$status,
                'data' => $data,
                'message' => $message
            ]), $code
        );
    }

    public function cleanReturn($data, $code)
    {
        return response(
            json_encode($data),
            $code
        );
    }
}
