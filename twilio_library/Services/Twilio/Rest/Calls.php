<<<<<<< HEAD
<?php

class Services_Twilio_Rest_Calls
    extends Services_Twilio_ListResource
{

    public static function isApplicationSid($value)
    {
        return strlen($value) == 34
            && !(strpos($value, "AP") === false);
    }

    public function create($from, $to, $url, array $params = array())
    {

        $params["To"] = $to;
        $params["From"] = $from;

        if (self::isApplicationSid($url))
            $params["ApplicationSid"] = $url;
        else
            $params["Url"] = $url;

        return parent::_create($params);
    }
}
=======
<?php

class Services_Twilio_Rest_Calls
    extends Services_Twilio_ListResource
{

    public static function isApplicationSid($value)
    {
        return strlen($value) == 34
            && !(strpos($value, "AP") === false);
    }

    public function create($from, $to, $url, array $params = array())
    {

        $params["To"] = $to;
        $params["From"] = $from;

        if (self::isApplicationSid($url))
            $params["ApplicationSid"] = $url;
        else
            $params["Url"] = $url;

        return parent::_create($params);
    }
}
>>>>>>> 702de34b50b724dc6a3047636c5b647f6f43666a
