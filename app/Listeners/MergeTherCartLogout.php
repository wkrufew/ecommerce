<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Gloudemans\Shoppingcart\Facades\Cart;

class MergeTherCartLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        //eliminar registro
        Cart::erase(auth()->user()->id);

        //nuevo registro
        Cart::store(auth()->user()->id);
    }
}
