<?php

// Register component on container
$container['templates'] = function ($container) {
  $view = new \Slim\Views\Twig(
    $container['settings']['templates']['template_path'],
    $container['settings']['templates']['twig'],
    [
      'debug' => true // This line should enable debug mode
    ]
  );

  // Instantiate and add Slim specific extension
  $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
  $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

  return $view;
};

$container['validator'] = function ($container) {
  $validator = new \Country\Validator();
  return $validator;
};
$container['soapWrapper'] = function ($container) {
  $validator = new \Country\SoapWrapper();
  return $validator;
};

$container['countryDetailsModel'] = function ($container) {
  $model = new \Country\CountryDetailsModel();
  return $model;
};

$container['processOutput'] = function ($container) {
  $model = new \Country\ProcessOutput();
  return $model;
};

$container['xmlParser'] = function ($container) {
  $model = new \Country\XmlParser();
  return $model;
};
