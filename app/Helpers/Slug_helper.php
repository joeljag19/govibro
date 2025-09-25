<?php

if (!function_exists('limpiar_string')) {
    /**
     * Limpia un string de acentos, eñes y otros caracteres especiales
     * para dejarlo listo para ser convertido en un slug de URL.
     *
     * @param string $string El texto de entrada.
     * @return string El texto limpio.
     */
    function limpiar_string(string $string): string
    {
        $string = trim($string);

        $string = str_replace(
            ['á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'],
            ['a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'],
            $string
        );

        $string = str_replace(
            ['é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'],
            ['e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'],
            $string
        );

        $string = str_replace(
            ['í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'],
            ['i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'],
            $string
        );

        $string = str_replace(
            ['ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'],
            ['o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'],
            $string
        );

        $string = str_replace(
            ['ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'],
            ['u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'],
            $string
        );

        $string = str_replace(
            ['ñ', 'Ñ', 'ç', 'Ç'],
            ['n', 'N', 'c', 'C'],
            $string
        );

        $string = str_replace(
            ['#', '@', '|', '!', '"', '·', '$', '%', '&', '/', '(', ')', '?', "'", '¡', '¿', '[', '^', '`', ']', '+', '}', '{', '¨', '´', '>', '<', ';', ',', ':', '.'],
            '',
            $string
        );

        return $string;
    }
}