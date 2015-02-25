<?php

/**
 * @param double $cReal
 * @param double $cImag
 * @param int $maxIterations
 * @return int
 */
function mandelbrotIteration($cReal, $cImag, $maxIterations)
{
    $originalReal = $cReal;
    $originalImag = $cImag;

    $ni = 0;
    while ($ni < $maxIterations && ($cReal * $cReal * $cImag * $cImag < 4.0)) {
        $tmp = $cReal * $cReal - $cImag * $cImag + $originalReal;
        $cImag = $cImag * $cReal * 2 + $originalImag;
        $cReal = $tmp;

        $ni++;
    }

    if ($ni == $maxIterations) {
        $ni = 0;
    }

    return $ni;
}

