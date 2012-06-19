<<<<<<< HEAD
<?php

class Services_Twilio_RestException
    extends Exception
{
    protected $status;
    protected $info;

    public function __construct($status, $message, $code = 0, $info = '')
    {
        $this->status = $status;
        $this->info = $info;
        parent::__construct($message, $code);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getInfo()
    {
        return $this->info;
    }
}
=======
<?php

class Services_Twilio_RestException
    extends Exception
{
    protected $status;
    protected $info;

    public function __construct($status, $message, $code = 0, $info = '')
    {
        $this->status = $status;
        $this->info = $info;
        parent::__construct($message, $code);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getInfo()
    {
        return $this->info;
    }
}
>>>>>>> 702de34b50b724dc6a3047636c5b647f6f43666a
