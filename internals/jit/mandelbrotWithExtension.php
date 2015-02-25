<?php
ini_set('memory_limit', -1);
define('MAX_ITERATIONS', 4096);
require('vendor/autoload.php');

function mandelbrot($xMin, $xMax, $yMin, $yMax, $xPx, $yPx) {

    $dx = ($xMax - $xMin) / $xPx;
    $dy = ($yMax - $yMin) / $yPx;
    $rows = [];

    for ($iy = 0; $iy < $yPx; $iy++) {
        $row = [];

        for ($ix = 0; $ix < $xPx; $ix += 1) {
            $cReal = $xMin + $ix * $dx;
            $cImag = $yMax - $iy * $dy;
            $row[] = mandelbrotIteration($cReal, $cImag, MAX_ITERATIONS);
        }

        $rows[] = $row;
    }

    return $rows;
}

if (!function_exists('mandelbrotIteration')) {
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
}

function render($filename, $xPx, $yPx, $data)
{
    $image = imagecreate($xPx, $yPx);
    $colours = [];

    for ($y = 0; $y < $yPx; $y++) {
        for ($x = 0; $x < $xPx; $x++) {
            $iterations = (int) $data[$y][$x];

            if ($iterations == MAX_ITERATIONS) {
                $colour = [0, 0, 0];  /* In the set. Assign black. */
            } else if ($iterations < 64) {
                $colour = [$iterations * 2, 0, 0];    /* 0x0000 to 0x007E */
            } else if ($iterations < 128) {
                $colour = [((($iterations - 64) * 128) / 126) + 128, 0, 0];    /* 0x0080 to 0x00C0 */
            } else if ($iterations < 256) {
                $colour = [((($iterations - 128) * 62) / 127) + 193, 0, 0];    /* 0x00C1 to 0x00FF */
            } else if ($iterations < 512) {
                $colour = [255, ((($iterations - 256) * 62) / 255) + 1, 0];    /* 0x01FF to 0x3FFF */
            } else if ($iterations < 1024) {
                $colour = [255, ((($iterations - 512) * 63) / 511) + 64, 0];   /* 0x40FF to 0x7FFF */
            } else if ($iterations < 2048) {
                $colour = [255, ((($iterations - 1024) * 63) / 1023) + 128, 0];   /* 0x80FF to 0xBFFF */
            } else if ($iterations < 4096) {
                $colour = [255, ((($iterations - 2048) * 63) / 2047) + 192, 0];   /* 0xC0FF to 0xFFFF */
            } else {
                $colour = [255, 255, 0];
            }

            $colourString = sprintf("rgb(%d,%d,%d)", $colour[0], $colour[1], $colour[2]);
            if (isset($colours[$colourString])) {
                $colour = $colours[$colourString];

            } else {
                $colour = imagecolorallocate($image, $colour[0], $colour[1], $colour[2]);
                $colours[$colourString] = $colour;
            }

            imagesetpixel($image, $x, $y, $colour);
        }
    }

    imagepng($image, $filename);
}


function main() {

    $xMin = -2.0;
    $xMax = 1.0;
    $yMin = -1.0;
    $yMax = 1.0;

    $xPx = 800;
    $yPx = 512;

    $start = microtime(true);
    $data = mandelbrot($xMin, $xMax, $yMin, $yMax, $xPx, $yPx);
    $mandelTime = microtime(true) - $start;
    printf("Data took %F\n", $mandelTime);

    $start = microtime(true);
    render('mandel.png', $xPx, $yPx, $data);
    $renderTime = microtime(true) - $start;
    printf("Render took %F\n", $renderTime);
}

main();
