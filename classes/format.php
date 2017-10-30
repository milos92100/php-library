<?php namespace phplibrary;
/**
* Format methods
*/
class Format{
    protected static $ip_locator           = 'http://www.infosniper.net/index.php?ip_address=';
    protected static $ip_localhost_address = '::1';
    protected static $ip_localhost_name    = 'Localhost';
    protected static $utf_8                = 'utf-8';
    protected static $windows_1250         = 'windows-1250';
    protected static $units                = array('B', 'KB', 'MB', 'GB', 'TB'); 
    
    // -------------------------------------------------------------------------
    
    /**
    * Converts bytes
    * 
    * @param int $bytes
    * @param Bool $to_round
    * @param int $round_precision
    * 
    * @return String $megabytes
    */
    public static function bytes($bytes, $to_round=TRUE, $round_precision=2)
    {
        $bytes = max($bytes, 0); 
        $pow   = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow   = min($pow, count(self::$units) - 1);
        $bytes = $bytes / pow(1024, $pow);
        
        if($to_round)
        {
            $bytes = round($bytes, $round_precision);
        }
        
        $data = array(
            'value' => $bytes,
            'sign'  => $bytes . ' ' . self::$units[$pow],
        );
        
        return $data;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formating query
    * 
    * @param String $query
    * 
    * @return String $formated_query
    */
    public static function query($query)
    {
        $queryPrint = str_ireplace('<', '&lt;', $query);
        $queryPrint = str_ireplace('>', '&gt;', $queryPrint);
        
        $formated_query = '<pre><code>' . $queryPrint . '</code></pre>';
        
        return $formated_query;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats telephone number
    * 
    * @param String $telephone
    * @param String $telephone_backup
    * 
    * @return String $result
    */
    public static function telephone($telephone='', $telephone_backup='')
    {
        if(empty($telephone))
        {
            $telephone = $telephone_backup;
        }
        
        if(empty($telephone))
        {
            $result = '';
        }
        else
        {
            $exploded_telephone = explode(' ', $telephone);
            
            $telephone_print = '';
            foreach($exploded_telephone as $row)
            {
                $telephone = trim($row);
                $telephone = preg_replace('/[^0-9,.]/', '', $telephone);
                $telephone_print .= $telephone; 
            }        

            $first  = substr($telephone_print, 0, 3);
            $second = substr($telephone_print, 3, 2);
            $third  = substr($telephone_print, 5, 2);
            $fourth = substr($telephone_print, 7, 5);
            
            if(empty($exploded_telephone))
            {
                $result = 'N/A';                    
            }
            else
            {
                $result = $first . '/' . $second . '-' . $third . '-' . $fourth;
            }
        }
    
        return $result;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats website URL
    * 
    * @param String $location
    * @param Bool $name
    * 
    * @return String
    */
    public static function website($location, $name=FALSE)
    {
        $prefix_protocol = 'http://';
        $prefix_web      = 'www.';
        
        if(strpos($location, $prefix_web) !== FALSE)
        {
            $prefix = $prefix_protocol;
        }
        else
        {
            $prefix = $prefix_protocol . $prefix_web;   
        }
        
        $location_final = $prefix . $location;
        
        if($name)
        {
            return $location_final;
        }
        else
        {
            return ' ' . '<a href="' . $location_final . '" target="_blank">' . $location . '</a>' . ' ';
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formats IP addres and creates URL to more information
    * 
    * @param String $ip
    * 
    * @return String
    */
    public static function ip($ip)
    {
        if($ip == self::$ip_localhost_address)
        {
            return self::$ip_localhost_name;
        }
        else
        {
            return '<a href="' . self::$ip_locator . $ip . '" target="_blank">' . $ip . '</a>';
        }
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Reformats string to start with big first letter
    * 
    * @param String $title
    * 
    * @return String
    */
    public static function title_case($title)
    {
        return ucfirst(strtolower($title));
    }
    
    // -------------------------------------------------------------------------

    /**
    * Converting number to specific format
    * 
    * @param float $number
    * @param Bool $with_decimal
    * @param int $value
    * 
    * @return String $converted
    */
    public static function number($number, $with_decimal=TRUE, $value=1000000)
    {
        if(empty($number))
        {
            $converted = '';
        }
        else
        {
            if($with_decimal)
            {
                $converted = number_format($number/$value, 1, '.', '');
                if($converted < 1)
                {
                    $converted = substr($converted, 1, 2);
                }
            }
            else
            {
                $converted = number_format($number/$value, 0, '.', '');
            }
        }
        
        return $converted;
    }
    
    // -------------------------------------------------------------------------

    /**
    * Convert given data to readable format
    * 
    * @param mixed $data
    * 
    * @return void
    */
    public static function pre($data)
    {
        print_r('<pre>');
        print_r($data);
        print_r('</pre>');
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Converting string from Windows-1250 to UTF-8
    * 
    * @param String $string
    * 
    * @return String $converted
    */
    public static function windows_to_utf($string)
    {
        $converted = iconv(self::$windows_1250, self::$utf_8, $string);
        
        return $converted;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Converting string from UTF-8 to Windows-1250
    * 
    * @param String $string
    * 
    * @return String $converted
    */
    public static function utf_to_windows($string)
    {
        $converted = iconv(self::$utf_8, self::$windows_1250, $string);
        
        return $converted;
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Formating shortened string
    * 
    * @param String $string
    * @param int $start
    * @param int $length
    * 
    * @return String $corrected
    */
    public static function string($string, $start=0, $length=15)
    {
        if(strlen($string) > $length)
        {
            $corrected = substr($string, $start, $length) . '...';
        }
        else
        {
            $corrected = $string;    
        }
        
        return $corrected;    
    }
    
    // -------------------------------------------------------------------------
}
?>