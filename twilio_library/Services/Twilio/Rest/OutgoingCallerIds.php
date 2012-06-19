<<<<<<< HEAD
<?php

class Services_Twilio_Rest_OutgoingCallerIds
    extends Services_Twilio_ListResource
{
    public function create($phoneNumber, array $params = array())
    {
        return parent::_create(array(
            'PhoneNumber' => $phoneNumber,
        ) + $params);
    }
}
=======
<?php

class Services_Twilio_Rest_OutgoingCallerIds
    extends Services_Twilio_ListResource
{
    public function create($phoneNumber, array $params = array())
    {
        return parent::_create(array(
            'PhoneNumber' => $phoneNumber,
        ) + $params);
    }
}
>>>>>>> 702de34b50b724dc6a3047636c5b647f6f43666a
