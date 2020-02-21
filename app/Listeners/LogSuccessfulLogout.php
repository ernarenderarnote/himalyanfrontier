<?php

    namespace App\Listeners;
    use Illuminate\Auth\Events\Logout;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Symfony\Component\HttpFoundation\Cookie;
    use Illuminate\Http\Request;
    use Auth;

    class LogSuccessfulLogout
    {
        /**
         * Create the event listener.
         *
         * @return void
         */
        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        /**
         * Handle the event.
         *
         * @param  Logout  $event
         * @return void
         */
        public function handle(Logout $event)
        {
           // dd(Auth::user()->roles()->first()->title);
            setcookie('user_type', Auth::user()->roles()->first()->title, time() + (86400 * 30), "/");  
        }
    }