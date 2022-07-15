<?php

namespace Country;

/**
 * Provides an interface for connecting to and retrieving data from web service via SOAP.
 */
class SoapWrapper
{

    public function __construct(){}
    public function __destruct(){}

    public function createSoapClient()
    {
        $soap_client_handle = false;
        $soap_client_parameters = array();
        $exception = '';
        $wsdl = WSDL;

        $soap_client_parameters = ['trace' => true, 'exceptions' => true];

        try
        {
            $soap_client_handle = new \SoapClient($wsdl, $soap_client_parameters);
//            var_dump($soap_client_handle->__getFunctions());
//            var_dump($soap_client_handle->__getTypes());
        }
        catch (\SoapFault $exception)
        {
            $soap_client_handle = 'SOAP: Could not connect.  Please try again later';
        }
        return $soap_client_handle;
    }

    /**
     * Make SOAP call.
     * 
     * @param soap_client Soap client handle.
     * @param web_function
     * @param web_parameters
     */
    public function performSoapCall($soap_client, $web_function, $web_parameters, $web_value)
    {
        $soap_call_result = null;
        $raw_xml = '';

        if ($soap_client)
        {
            try
            {
                $web_result = $soap_client->{$web_function}($web_parameters);
                $soap_call_result = $web_call_result->{$web_value};
            }
            catch (\SoapFault $exception)
            {
                $soap_call_result = $exception;
            }
        }
        return $soap_call_result;
    }
}