<?php
/**
* Temperature
*
* Working with temperature conversions
*
* @package      PHP Library
* @subpackage   phplibrary
* @category     Temperature
* @author       Zlatan Stajić <contact@zlatanstajic.com>
*/
namespace phplibrary;

/**
* Working with temperature conversions
*/
class Temperature {

    // -------------------------------------------------------------------------

    /**
    * Absolute zero value
    *
    * @var float
    */
    protected static $absolute_zero = 273.15;

    // -------------------------------------------------------------------------

    /**
    * Temperature signs
    *
    * @var array
    */
    protected static $signs = array(
        'celsius'    => '&degC',
        'fahrenheit' => 'F',
        'kelvin'     => 'K',
    );

    // -------------------------------------------------------------------------

    /**
    * Kelvin to Celsius conversion
    *
    * @param float $temp
    * @param bool $round_value
    *
    * @return mixed
    */
    public static function k_to_c($temp, $round_value=FALSE)
    {
        if (is_numeric($temp))
        {
            $celsius = ($temp - self::$absolute_zero);

            if ($round_value)
            {
                $celsius = round($celsius);
            }

            $celsius_with_sign  = $celsius;
            $celsius_with_sign .= ' ';
            $celsius_with_sign .= self::$signs['celsius'];

            return array(
                'value' => $celsius,
                'sign'  => $celsius_with_sign,
            );
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Kelvin to Fahrenheit conversion
    *
    * @param float $temp
    * @param bool $round_value
    *
    * @return mixed
    */
    public static function k_to_f($temp, $round_value=FALSE)
    {
        if (is_numeric($temp))
        {
            $fahrenheit = (($temp - self::$absolute_zero) * (9 / 5)) + 32;

            if ($round_value)
            {
                $fahrenheit = round($fahrenheit);
            }

            $fahrenheit_with_sign  = $fahrenheit;
            $fahrenheit_with_sign .= ' ';
            $fahrenheit_with_sign .= self::$signs['fahrenheit'];

            return array(
                'value' => $fahrenheit,
                'sign'  => $fahrenheit_with_sign,
            );
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Fahrenheit to Celsius conversion
    *
    * @param float $temp
    * @param bool $round_value
    *
    * @return mixed
    */
    public static function f_to_c($temp, $round_value=FALSE)
    {
        if (is_numeric($temp))
        {
            $celsius = ($temp - 32) * (5 / 9);

            if ($round_value)
            {
                $celsius = round($celsius);
            }

            $celsius_with_sign  = $celsius;
            $celsius_with_sign .= ' ';
            $celsius_with_sign .= self::$signs['celsius'];

            return array(
                'value' => $celsius,
                'sign'  => $celsius_with_sign,
            );
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Fahrenheit to Kelvin conversion
    *
    * @param float $temp
    * @param bool $round_value
    *
    * @return mixed
    */
    public static function f_to_k($temp, $round_value=FALSE)
    {
        if (is_numeric($temp))
        {
            $kelvin = ($temp + 459.67) * (5 / 9);

            if ($round_value)
            {
                $kelvin = round($kelvin);
            }

            $kelvin_with_sign  = $kelvin;
            $kelvin_with_sign .= ' ';
            $kelvin_with_sign .= self::$signs['kelvin'];

            return array(
                'value' => $kelvin,
                'sign'  => $kelvin_with_sign,
            );
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Celsius to Fahrenheit conversion
    *
    * @param float $temp
    * @param bool $round_value
    *
    * @return mixed
    */
    public static function c_to_f($temp, $round_value=FALSE)
    {
        if (is_numeric($temp))
        {
            $fahrenheit = ($temp * (9 / 5)) + 32;

            if ($round_value)
            {
                $fahrenheit = round($fahrenheit);
            }

            $fahrenheit_with_sign  = $fahrenheit;
            $fahrenheit_with_sign .= ' ';
            $fahrenheit_with_sign .= self::$signs['fahrenheit'];

            return array(
                'value' => $fahrenheit,
                'sign'  => $fahrenheit_with_sign,
            );
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------

    /**
    * Celsius to Kelvin conversion
    *
    * @param float $temp
    * @param bool $round_value
    *
    * @return mixed
    */
    public static function c_to_k($temp, $round_value=FALSE)
    {
        if (is_numeric($temp))
        {
            $kelvin = $temp + self::$absolute_zero;

            if ($round_value)
            {
                $kelvin = round($kelvin);
            }

            $kelvin_with_sign  = $kelvin;
            $kelvin_with_sign .= ' ';
            $kelvin_with_sign .= self::$signs['kelvin'];

            return array(
                'value' => $kelvin,
                'sign'  => $kelvin_with_sign,
            );
        }

        return FALSE;
    }

    // -------------------------------------------------------------------------
}
