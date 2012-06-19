<<<<<<< HEAD
==================
Accounts
==================

Updating Account Information
==============================

Updating :class:`Account` information is really easy:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $account = $client->account;
    $account->update(array('name' => 'My Awesome Account'));

Creating a Subaccount
==============================

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $subaccount = $client->accounts->create(array(
      'name' => 'My Awesome SubAccount'
    ));
=======
==================
Accounts
==================

Updating Account Information
==============================

Updating :class:`Account` information is really easy:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $account = $client->account;
    $account->update(array('name' => 'My Awesome Account'));

Creating a Subaccount
==============================

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $subaccount = $client->accounts->create(array(
      'name' => 'My Awesome SubAccount'
    ));
>>>>>>> 702de34b50b724dc6a3047636c5b647f6f43666a
