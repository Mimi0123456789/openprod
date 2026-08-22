<?php

/*
|--------------------------------------------------------------------------
| OPENPROD 2 - BOOTSTRAP GLOBAL
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_cache_limiter('nocache');
    session_start();
}

/*
|--------------------------------------------------------------------------
| ROOT PATH
|--------------------------------------------------------------------------
*/

define('ROOT_PATH', dirname(__DIR__));

/*
|--------------------------------------------------------------------------
| CONFIG APPLICATION
|--------------------------------------------------------------------------
*/

define('APP_NAME', 'OPENPROD');
define('APP_VERSION', '2.0');
define('APP_ENV', 'local');

/*
|--------------------------------------------------------------------------
| TIMEZONE
|--------------------------------------------------------------------------
*/

date_default_timezone_set('Europe/Paris');

/*
|--------------------------------------------------------------------------
| AFFICHAGE DES ERREURS (DEV)
|--------------------------------------------------------------------------
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/*
|--------------------------------------------------------------------------
| HELPERS
|--------------------------------------------------------------------------
*/

/**
 * Debug
 */
function dd($data)
{
    echo '<pre style="
        background:#111;
        color:#00ff88;
        padding:20px;
        border-radius:10px;
        font-size:14px;
    ">';
    
    print_r($data);

    echo '</pre>';
    die();
}

/**
 * Vérifie connexion utilisateur
 */
function isConnected()
{
    return isset($_SESSION['utilisateurs']);
}

/**
 * Utilisateur courant
 */
function currentUser()
{
    return $_SESSION['utilisateurs'] ?? null;
}

/**
 * Redirection
 */
function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

/**
 * Protection XSS
 */
function e($string)
{
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Date FR
 */
function formatDateFr($date)
{
    if (!$date) {
        return '';
    }

    return date('d/m/Y', strtotime($date));
}

/**
 * Date heure FR
 */
function formatDateTimeFr($date)
{
    if (!$date) {
        return '';
    }

    return date('d/m/Y H:i', strtotime($date));
}

/**
 * Génération badge priorité
 */
function priorityColor($priority)
{
    switch ($priority) {

        case 'Urgent':
        case '12h':
        case '24h':
            return '#dc3545';

        case '48H':
            return '#f47a00';

        case '7 JOURS':
        case '15 Jours':
            return '#198754';

        default:
            return '#14395b';
    }
}

/**
 * Vérifie si admin
 */
function isAdmin()
{
    if (!isset($_SESSION['utilisateurs'])) {
        return false;
    }

    return (
        $_SESSION['utilisateurs']['id_fonctions'] == 1
        || $_SESSION['utilisateurs']['id_fonctions'] == 6
    );
}

/*
|--------------------------------------------------------------------------
| AUTH GUARD
|--------------------------------------------------------------------------
*/

function requireAuth()
{
    if (!isConnected()) {

        header('Location: connexion.php');
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| CSRF TOKEN
|--------------------------------------------------------------------------
*/

if (empty($_SESSION['csrf_token'])) {

    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}