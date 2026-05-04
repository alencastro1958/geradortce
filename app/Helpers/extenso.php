<?php

if (!function_exists('numero_extenso')) {
    /**
     * Converte um número inteiro para sua representação por extenso em português.
     */
    function numero_extenso(int $n): string
    {
        if ($n < 0) {
            return 'menos ' . numero_extenso(-$n);
        }

        if ($n === 0) return 'zero';

        $unidades = [
            '', 'um', 'dois', 'três', 'quatro', 'cinco', 'seis', 'sete', 'oito', 'nove',
            'dez', 'onze', 'doze', 'treze', 'quatorze', 'quinze',
            'dezesseis', 'dezessete', 'dezoito', 'dezenove',
        ];

        $dezenas = [
            '', '', 'vinte', 'trinta', 'quarenta', 'cinquenta',
            'sessenta', 'setenta', 'oitenta', 'noventa',
        ];

        $centenas = [
            '', 'cento', 'duzentos', 'trezentos', 'quatrocentos', 'quinhentos',
            'seiscentos', 'setecentos', 'oitocentos', 'novecentos',
        ];

        if ($n < 20) {
            return $unidades[$n];
        }

        if ($n < 100) {
            $d = intdiv($n, 10);
            $u = $n % 10;
            return $dezenas[$d] . ($u ? ' e ' . $unidades[$u] : '');
        }

        if ($n === 100) {
            return 'cem';
        }

        if ($n < 1000) {
            $c = intdiv($n, 100);
            $resto = $n % 100;
            return $centenas[$c] . ($resto ? ' e ' . numero_extenso($resto) : '');
        }

        if ($n < 1_000_000) {
            $milhares = intdiv($n, 1000);
            $resto = $n % 1000;
            $milStr = $milhares === 1 ? 'um mil' : numero_extenso($milhares) . ' mil';

            if ($resto === 0) return $milStr;

            // "e" apenas quando o resto é < 100 ou múltiplo exato de 100
            $conector = ($resto < 100 || $resto % 100 === 0) ? ' e ' : ' ';
            return $milStr . $conector . numero_extenso($resto);
        }

        // Fallback para números muito grandes
        return (string) $n;
    }
}

if (!function_exists('valor_extenso')) {
    /**
     * Converte um valor monetário (float) para extenso em português.
     * Exemplo: 1253.88 => "um mil duzentos e cinquenta e três Reais e oitenta e oito centavos"
     */
    function valor_extenso(float $valor): string
    {
        $inteiro   = (int) floor(abs($valor));
        $centavos  = (int) round((abs($valor) - $inteiro) * 100);

        $reaisStr = numero_extenso($inteiro) . ($inteiro === 1 ? ' Real' : ' Reais');

        if ($centavos === 0) {
            return $reaisStr;
        }

        $centavosStr = numero_extenso($centavos) . ($centavos === 1 ? ' centavo' : ' centavos');
        return $reaisStr . ' e ' . $centavosStr;
    }
}
