<<<<<<< HEAD
<?php

class Services_Twilio_Rest_Applications
    extends Services_Twilio_ListResource
{
    public function create($name, array $params = array())
    {
        return parent::_create(array(
            'FriendlyName' => $name
        ) + $params);
    }
}
=======
<?php

class Services_Twilio_Rest_Applications
    extends Services_Twilio_ListResource
{
    public function create($name, array $params = array())
    {
        return parent::_create(array(
            'FriendlyName' => $name
        ) + $params);
    }
}
>>>>>>> 702de34b50b724dc6a3047636c5b647f6f43666a
