<?php

namespace App\Listeners;

use App\Events\NotificationSenderEvent;
use App\Models\Notification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class SendNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NotificationSenderEvent $event)
    {
        //
        $this->sendOneNotification($event);
    }



    public function sendOneNotification( $event )
    {



        $notificationData = $event->notification;

        $notification = new Notification();
        foreach ( $notificationData as $k => $v){
            $notification->{$k}= $v;
        }
        $notification->save();

        try {
            $optionBuiler = new OptionsBuilder();
            $optionBuiler->setTimeToLive(60 * 20);

            $notificationBuilder = new PayloadNotificationBuilder('HandiMan');

            $notificationBuilder->setBody($event->notification['message'])
                ->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['data' => $notificationData]);

            $option = $optionBuiler->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();

            //$token = User::;
            $token = $event->notification['to'];

            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();

            //return Array - you must remove all this tokens in your database
            $downstreamResponse->tokensToDelete();

            //return Array (key : oldToken, value : new token - you must change the token in your database )
            $downstreamResponse->tokensToModify();

            //return Array - you should try to resend the message to the tokens in the array
            $downstreamResponse->tokensToRetry();
            Log::info($downstreamResponse->numberSuccess());
            return $downstreamResponse->numberSuccess();
        } catch (\Exception $e) {
            return false;
        }
    }
}
