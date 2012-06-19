<<<<<<< HEAD
=============
SMS Mesages
=============

Sending a SMS Message
=====================

The :class:`SmsMessages` resource allows you to send outgoing text messages

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $message = $client->account->sms_messages->create(
      '9991231234', // From this number
      '8881231234', // Text this number
      "Hello monkey!"
    );

    print $message->sid;
=======
=============
SMS Mesages
=============

Sending a SMS Message
=====================

The :class:`SmsMessages` resource allows you to send outgoing text messages

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $message = $client->account->sms_messages->create(
      '9991231234', // From this number
      '8881231234', // Text this number
      "Hello monkey!"
    );

    print $message->sid;
>>>>>>> 702de34b50b724dc6a3047636c5b647f6f43666a
