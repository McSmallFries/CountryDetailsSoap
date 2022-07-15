<?php
/**
 * homepage.php
 *
 * display the homepage
 *
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * provide variable names and values and render the html output to be displayed.
 */
$app->get('/', function(Request $request, Response $response) use ($app)
{

    $country_names = getCountryNamesAndIsoCodes($app);
//var_dump($country_names);
    $html_output = $this->view->render($response,
    'homepageform.html.twig',
    [
      'css_path' => CSS_PATH,
      'landing_page' => LANDING_PAGE,
      'method' => 'post',
      'action' => 'processcountrydetails',
      'initial_input_box_value' => null,
      'page_title' => APP_NAME,
      'page_heading_1' => APP_NAME,
      'page_heading_2' => 'Display details about a country',
      'country_names' => $country_names,
      'page_text' => 'Select a country name, then select the required information details',
    ]);

    $processed_output = processOutput($app, $html_output);

    return $processed_output;

})->setName('homepage');

/**
 * delegate to Slim ProcessOutput
 */
function processOutput($app, $html_output)
{
    $process_output = $app->getContainer()->get('processOutput');
    $html_output = $process_output->processOutput($html_output);
    return $html_output;
}

/**
 * Get the data from soap call stored in the country details model.
 */
function getCountryNamesAndIsoCodes($app)
{
    $country_detail_result = [];
    $soap_wrapper = $app->getContainer()->get('soapWrapper');

    $countrydetails_model = $app->getContainer()->get('countryDetailsModel');
    $countrydetails_model->setSoapWrapper($soap_wrapper);

    $countrydetails_model->retrieveCountryNames();
    $country_detail_result = $countrydetails_model->getResult();

    return $country_detail_result;

}