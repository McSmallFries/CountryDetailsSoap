<?php
/**
 * Settings for the web application passed to the container in the dependencies script.
 */

ini_set('display_errors', 'On');
ini_set('html_errors', 'On');
ini_set('xdebug.trace_output_name', 'country_details.%t');

define('DIRSEP', DIRECTORY_SEPARATOR);

$url_root = $_SERVER['SCRIPT_NAME'];
$url_root = implode('/', explode('/', $url_root, -1));
$css_path = $url_root . '/css/standard.css';
define('CSS_PATH', $css_path);
define('APP_NAME', 'Country Details');
define('LANDING_PAGE', $_SERVER['SCRIPT_NAME']);

/**
 * the wsdl handle, defined globally for ease.
 */
$wsdl = 'http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL';
define('WSDL', $wsdl);

$detail_types = ['capital', 'continents', 'full', 'gmt'];
define('DETAIL_TYPES', $detail_types);

/**
 * the actual settings that this script returns and those that are passed to container.
 */
$settings = [
  "settings" => [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
    'mode' => 'development',
    'debug' => true,
    'class_path' => __DIR__ . '/src/',
    'templates' => [
      'template_path' => __DIR__ . '/templates/',
      'twig' => [
        'cache' => false,
        'auto_reload' => true,
      ]],
  ],
];

return $settings;
