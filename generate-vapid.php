<?php

require 'vendor/autoload.php';

use Minishlink\WebPush\VAPID;

// Génère des clés VAPID
$keys = VAPID::createVapidKeys();

echo "VAPID_PUBLIC_KEY=" . $keys['publicKey'] . "\n";
echo "VAPID_PRIVATE_KEY=" . $keys['privateKey'] . "\n";
