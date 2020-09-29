<?php

namespace App\Services\Utils;

class ConvertLinesService
{
    /**
     * Converte linhas com campos separados por ponto e vírgula em array
     *
     * @param $lines Array
     * @param $headers Array
     */
    public function convertToArray($lines, $headers)
    {
        $finalArray = [];

        foreach ($lines as $key => $line) {
            $fields = [];
            $fields = explode(';', $line);

            $array = [];
            foreach ($headers as $index => $header) {
                $array[$header] = $fields[$index];
            }
            $finalArray[] = $array;
        }

        return $finalArray;
    }

    public function convertToColletion($lines, $headers)
    {
        $array = $this->convertToArray($lines, $headers);

        $collection = collect($array);

        return $collection;
    }
}
