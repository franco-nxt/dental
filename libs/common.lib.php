<?php 

/*
 * ------------------
 * COMMONS
 * ------------------
 *
 * Cargo todas las utilidades del sitio
 * 
 */

require_once "classes.lib.php";

@session_start();

remove_magic_quotes();

require_once "config.lib.php";

require_once "constants.lib.php";

require_once "behaviors.lib.php";

// La función elimina los magic_quotes en el caso que estén activados por el servidor.
function remove_magic_quotes() {
	if (get_magic_quotes_gpc()) {
		$process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
		while (list($key, $val) = each($process)) {
			foreach ($val as $k => $v) {
				unset($process[$key][$k]);
				if (is_array($v)) {
					$process[$key][stripslashes($k)] = $v;
					$process[] = &$process[$key][stripslashes($k)];
				} else {
					$process[$key][stripslashes($k)] = stripslashes($v);
				}
			}
		}
		unset($process);
	}
}

/*
  Redimensiona una imÃ¡gen. (por: Juano - rigoli82@gmail.com)
  @string src: Archivo de origen.
  @int ancho_final: Ancho final de la imÃ¡gen
  @int alto_final: Alto final de la imÃ¡gen
  @int flags :
  RESAMPLE_NORMAL: Resampleo normal (encaja en ancho/alto manteniendo proporciÃ³n);
  RESAMPLE_TRIM_X: RedimensiÃ³n proporcional a Y, y corta lo excedente en X;
  RESAMPLE_TRIM_Y: RedimensiÃ³n proporcional a X, y corta lo excedente en Y;
  RESAMPLE_TRIM: Redimensiona con respecto a la menor medida, y corta el excedente;
  @string dest: Archivo de destino, si no se define se guarda en el mismo archivo (src).
  @int qratio: Calidad de compresiÃ³n, por defecto: 100 (max).
  @full image: Mantiene la imagen original y la inserta sobre un recuadro de la imagen maxima.
  @string mime: Tipo MIME de archivo, si es null intenta identificarlo por su extensiÃ³n.
 */
define('RESAMPLE_NORMAL', 0);
define('RESAMPLE_TRIM_X', 1);
define('RESAMPLE_TRIM_Y', 2);
define('RESAMPLE_TRIM', 3);

define('RESAMPLE_OUTPUT_JPG', 0);
define('RESAMPLE_OUTPUT_PNG', 1);

function img_resample($src, $ancho, $alto, $dest = null, $flags = 0, $qratio = 100, $full = 0, $output = RESAMPLE_OUTPUT_JPG) {

    if ($full) {
        $anchoO = $ancho;
        $altoO = $alto;
    }

    if (!$src || !file_exists($src)) {
        if (@DEBUG)
            return("img_resample(): No existe el archivo '{$src}' .");
        return false;
    }

    $ancho = (int) $ancho;
    $alto = (int) $alto;

    if (!$ancho || !$alto) {
        if (@DEBUG)
            return("img_resample(): No se especificaron correctamente las dimensiones ('{$ancho}'x'{$alto}').");
        return false;
    }

    if ($output == RESAMPLE_OUTPUT_PNG) {
        $compress = 100 - $qratio;
    }


    $imginfo = getimagesize($src);

    if (!@$imginfo['mime']) {
        if (@DEBUG)
            return("img_resample(): No se pudo leer el la informaci&oacute;n de la im&aacute;gen.");
        return false;
    }

    switch ($imginfo['mime']) {
        case 'image/jpeg':
            $imgcache = @imagecreatefromjpeg($src);
            break;
        case 'image/gif':
            $imgcache = @imagecreatefromgif($src);
            break;
        case 'image/png':
        default:
            $imgcache = @imagecreatefrompng($src);
            break;
    }

    if (!$imgcache) {
        if (@DEBUG)
            return("img_resample(): No se pudo leer la im&aacute;gen.");
        return false;
    }

    $x = imagesx($imgcache);
    $y = imagesy($imgcache);

    $ratio = $y / $x;
    $ratio2 = $alto / $ancho;

    if ($flags == RESAMPLE_TRIM) {
        if ($ratio2 > $ratio)
            $flags = RESAMPLE_TRIM_X;
        else
            $flags = RESAMPLE_TRIM_Y;
    }

    switch ($flags) {
        case RESAMPLE_TRIM_X:
            if ($y > $alto) {
                $y = $alto;
                $x = floor($y * (1 / $ratio));
            }
            if ($x < $ancho)
                $alto = $x;
            $imgmini = imagecreatetruecolor($ancho, $alto);
            break;
        case RESAMPLE_TRIM_Y:
            if ($x > $ancho) {
                $x = $ancho;
                $y = floor($x * $ratio);
            }
            if ($y < $alto)
                $alto = $y;
            $imgmini = imagecreatetruecolor($ancho, $alto);
            break;
        default:
            if ($y > $alto) {
                $y = $alto;
                $x = floor($y * (1 / $ratio));
            }

            if ($x > $ancho) {
                $x = $ancho;
                $y = floor($x * $ratio);
            }

            $imgmini = imagecreatetruecolor($x, $y);
            break;
    }

    if ($full) {
        $ancho = $anchoO;
        $alto = $altoO;
        $imgmini = imagecreatetruecolor($anchoO, $altoO);
    }

    if ($output == RESAMPLE_OUTPUT_PNG) {
        // Si es un png, creamos un lienzo transparente
        imagealphablending($imgmini, false);
        imagesavealpha($imgmini, true);
        $transparent = imagecolorallocatealpha($imgmini, 255, 255, 255, 127);
        imagefill($imgmini, 0, 0, $transparent);
    } else {
        // Sino, creamos uno en blanco
        $white = imagecolorallocate($imgmini, 255, 255, 255);
        imagefill($imgmini, 0, 0, $white);
    }

    // Creamos una imagen nueva


    $offset_x = 0;
    $offset_y = 0;

    if ($flags != RESAMPLE_NORMAL) {
        // calculamos el offset para centrar la nueva imagen
        $offset_x = floor(($ancho - $x) / 2);
        $offset_y = floor(($alto - $y) / 2);
    }

    // Insertamos la imagen original en nuestra nueva imagen.
    imagecopyresampled($imgmini, $imgcache, $offset_x, $offset_y, 0, 0, $x, $y, imagesx($imgcache), imagesy($imgcache));

    if (is_null($dest))
        $dest = $src;

    if ($output == RESAMPLE_OUTPUT_PNG) {
        $out = imagepng($imgmini, $dest, $compress);
    } else {
        $out = imagejpeg($imgmini, $dest, $qratio);
    }

    imagedestroy($imgmini);
    imagedestroy($imgcache);


    return $out;
}