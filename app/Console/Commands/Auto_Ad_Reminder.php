<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\Ad_Reminder;
use App\Models\User;


class Auto_Ad_Reminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:AdReminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = /*** write the logic to select from DB only the users who
     *
     * Have 24h before Ads     ***
     */

        if ($users->count() > 0) {
            foreach ($users as $user) {
                Mail::to($user)->send(new Ad_Reminder($user));
            }
        }

        return 0;
    }
}
