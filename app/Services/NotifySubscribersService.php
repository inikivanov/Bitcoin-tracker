<?php

namespace App\Services;

use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
use Illuminate\Support\Carbon;


class NotifySubscribersService
{
    /**
     * checkAndNotify
     * 
     * @author Ivan Ivanov
     * @param float $chartData
     */
    public function checkAndNotify($chartData = null)
    {
       
        if($chartData === null || (isset($chartData['message']) && $chartData['message'] == 'Unknown symbol')){
            return false;
        }
        //get subscribers for mailing and send mail and checkout they are notify
        return Subscription::where('amount', '<=', $chartData['last_price'])
                            ->where('active', '=', '1')
                            ->chunk(20, function ($subscribers) use ($chartData){
                                foreach($subscribers as $subscriber){
                                    $this->notify($subscriber, $chartData);
                                }
                            });
    }

    /**
     * Notify
     * 
     * @param $subscriber
     * 
     * @return MailMessage
     */
    public function notify($subscriber, $chartData)
    {
        dump($subscriber->email, $chartData['last_price']);

        $mailData = [

            'title' => __('notify.mail.title'),
            'body' => __('notify.mail.body', [
                        'price' => $chartData['last_price'], 
                        'datetime' => Carbon::parse($chartData['timestamp'])->toDateTimeString(),
                        'amount' => $subscriber->amount
            ])
        ];
        Mail::to($subscriber->email)->send(new NotifyMail($mailData));
    }
}
