<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class SendOrderEmailToAdmin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreatedEvent $event): void
    {
        // this query depends on business logic. for example more than one admin , wich admin and ....

        // we can also store users role in user table to prevent join but cause(Denormalization)

        //get users with role admins (Just One)
        $admin_email=DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')->where('roles.name', 'admin')
        ->first(['email']);
        Mail::to($admin_email)->send(new OrderMail($event->order_with_details , $event->products , $event->user));
        
    }
}
