<?php
/**
* Web_Service
*
* Web service related data
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Services
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

/**
* Web service related data
*/
class Web_Service {

    // -------------------------------------------------------------------------

    /**
    * Response from webservice
    *
    * @param string $web_service_url
    * @param array $params
    *
    * @return mixed
    */
    public static function response($web_service_url, $params=array())
    {
        if
        (
            function_exists('curl_init') &&
            self::check_file($web_service_url)['status']
        )
        {
            $ch = curl_init($web_service_url);

            isset($params['header'])
                ? curl_setopt($ch, CURLOPT_HEADER, $params['header'])
                : NULL;

            isset($params['user_agent'])
                ? curl_setopt($ch, CURLOPT_USERAGENT, $params['user_agent'])
                : NULL;

            isset($params['binary_transfer'])
                ? curl_setopt($ch, CURLOPT_BINARYTRANSFER, $params['binary_transfer'])
                : NULL;

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Convert response code to service status
    *
    * @param int $code
    *
    * @return array
    */
    public static function response_code($code)
    {
        $status = FALSE;

        switch ($code)
        {
            case 200:
            {
                $status = TRUE;
                break;
            }
        }

        return array(
            'status' => $status,
        );
    }

    // -------------------------------------------------------------------------

    /**
    * Reading response body
    *
    * Pass data values if your web service requires them
    *
    * @param string $web_service_url
    * @param string $data
    *
    * @return mixed
    */
    public static function response_body($web_service_url, $data=array())
    {
        if
        (
            function_exists('curl_init') &&
            self::check_file($web_service_url)['status']
        )
        {
            $data_string = json_encode($data);

            $ch = curl_init($web_service_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
            ));
            $result = curl_exec($ch);
            curl_close($ch);

            return json_decode($result, TRUE);
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Check if remote file exists
    *
    * @param string $url
    *
    * @return array
    */
    public static function check_file($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return array(
            'status' => self::response_code($code)['status'],
            'code'   => $code,
        );
    }

    // -------------------------------------------------------------------------
}
