<?php

namespace App\Notifications\Channels;

use App\Notifications\UserActivityNotification;
use Illuminate\Notifications\Notification;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class CustomPushChannel
{
    public function send($notifiable, UserActivityNotification $notification)
    {
        if (!method_exists($notification, 'toCustomPush')) {
            return;
        }

        $payload = $notification->toCustomPush($notifiable);

        $auth = [
            'VAPID' => [
                'subject' => config('webpush.vapid.subject'),
                'publicKey' => config('webpush.vapid.public_key'),
                'privateKey' => config('webpush.vapid.private_key'),
            ],
        ];

        $webPush = new WebPush($auth);

        foreach ($notifiable->pushSubscriptions as $subscription) {
            $sub = new Subscription(
                endpoint: $subscription->endpoint,
                publicKey: $subscription->public_key,
                authToken: $subscription->auth_token
            );

            $webPush->queueNotification(
                $sub,
                json_encode($payload)
            );
        }

        foreach ($webPush->flush() as $report) {
            if ($report->isSuccess()) {
                logger()->info("Notification envoyée à {$report->getEndpoint()}");
            } else {
                logger()->warning("Échec de l'envoi : {$report->getReason()}");
            }
        }
    }
}
