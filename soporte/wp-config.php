<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'soporte');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'master');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'Pr4y2ct4');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'DVtU>S(Rnpt)s=rR>7a7{~ojqQ$Ewz,_l8B*}%#*:WVRFl+iy,EnEzJOhXledVUO'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', '|~|.s4x pG_Z{yhh?Y tLu LU(~X0@5TclBB*7e5}6&[z-_46&J,~bvvDylYwPif'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', '$yS%uV]&f _^^%P~+7qyX!F_/pVhz@#i/#fqhpPC{Y;?A{11y6Lg@Ub#CI-g4|~N'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'GMPs#,?w|i6-Dr:+~+,cB//M4(y%Wa tRWr+q%(.s!5ly>g&yOiiJN1%.F-ZvRH{'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', '1=+J6^MD--_>ral#S-hcVR.hfookcfF2<go`MyS1_W>cd-^+o4|bRhi{+Anqrb}^'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'F6jbN[ZLb(y$HaZLt>B6)dJdMdy<Cnq<yT6-J0b`B`ZmF+0J7FLfdY8(t%*~_!WN'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', 'J?YA&X~5)6P |)dEKwE4qI?<AiMZk#;+kc8ke3t?+zM!26|w%6 c}[(~Zu&%`L[S'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', '>y]M?7->&$,.:c8-~|64=Tj|H#]M %_VS[8x3:#kLVYpH|8~P|-ck9+]yWZWE%`;'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

