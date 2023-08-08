<?php

namespace App\Observers;

use App\Mail\OrderAccept;
use App\Mail\OrderCreate;
use App\Mail\OrderDelivered;
use App\Mail\OrderSent;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderCancel;
use Illuminate\Support\Facades\Notification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $user = auth()->user();
        Mail::to($user->email)
        ->cc('smith93svam@gmail.com')
        ->queue(new OrderCreate($order, $user));
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {   
        $user=User::find($order->user_id);

        if ($order->status == 5) {
            /* Notification::queue($user, new OrderCancel()); */
            $delay = now()->addMinutes(2);
            $user->notify((new OrderCancel())->delay($delay));
        } elseif ($order->status == 4) {
            Mail::to($user->email)
            ->cc('smith93svam@gmail.com')
            /* ->queue(new OrderDelivered($order, $user)); */
            ->later(now()->addMinutes(2), new OrderDelivered($order, $user));
        } elseif ($order->status == 3) {
            Mail::to($user->email)
            ->cc('smith93svam@gmail.com')
            /* ->queue(new OrderSent($order, $user)); */
            ->later(now()->addMinutes(2), new OrderSent($order, $user));
        } elseif ($order->status == 2) {
            Mail::to($user->email)
            ->cc('smith93svam@gmail.com')
            /* ->queue(new OrderAccept($order, $user)); */
            ->later(now()->addMinutes(2), new OrderAccept($order, $user));
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
