<<<<<<< HEAD
<?php

class Services_Twilio_Rest_Call
    extends Services_Twilio_InstanceResource
{
    public function hangup()
    {
        $this->update('Status', 'completed');
    }

    protected function init()
    {
        $this->setupSubresources(
            'notifications',
            'recordings'
        );
    }
}
=======
<?php

class Services_Twilio_Rest_Call
    extends Services_Twilio_InstanceResource
{
    public function hangup()
    {
        $this->update('Status', 'completed');
    }

    protected function init()
    {
        $this->setupSubresources(
            'notifications',
            'recordings'
        );
    }
}
>>>>>>> 702de34b50b724dc6a3047636c5b647f6f43666a
