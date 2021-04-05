# Dynalist PHP Client

PHP Dynalist Client to interact with the Dynalist API.

## Installation using Composer

```sh
composer require lfbn/dynalist-client
```

## Quick view

```php
<?php

$dynalist = DynalistApi('your-api-key');

// get all documents from a file
$fileId = 'the-file-id';
$response = $dynalist->getDocumentContent($fileId);

var_dump($response);

// send something to inbox
$response = $dynalist->sendToInbox(0, 'hi to everyone!');

var_dump($response);
```
