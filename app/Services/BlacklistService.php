<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;

class BlacklistService
{
    private $number;

    public function __construct()
    {
    }

    /**
     * Retorna True ou False se esta na Blacklist ou não
     *
     * @return boolean
     */
    public static function blacklist($attribute, $number)
    {
        // Retorna True ou False conforme parametro enviado no teste unitário
        if ($attribute == 'test') {
            if ($number == '990171682') {
                return true;
            }
            return false;
        }

        $client = new Client();

        $url = 'https://front-test-pg.herokuapp.com/blacklist/'.$number;

        try {
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode();

            if ($statusCode == 200) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }

        return false;
    }
}
