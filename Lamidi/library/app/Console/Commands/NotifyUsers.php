<?php

namespace App\Console\Commands;

use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:notify';

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
        $users = Transaction::where('date_end')->get();
        foreach ($users as $user) {
            $diffInDays = $user->deadline_date->diff(Carbon::now())->days;

            $user->notify("Your deadline is in $diffInDays day!");
            return 0;
        }
    }
}
