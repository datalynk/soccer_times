<<<<<<< HEAD
================
Transcriptions
================

Show all Transcribed Messagse
=============================

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->transcriptions as $t) {
      print $t->transcription_text;
    }
=======
================
Transcriptions
================

Show all Transcribed Messagse
=============================

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->transcriptions as $t) {
      print $t->transcription_text;
    }
>>>>>>> 702de34b50b724dc6a3047636c5b647f6f43666a
