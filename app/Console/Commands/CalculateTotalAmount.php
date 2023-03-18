<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class CalculateTotalAmount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:total-amount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the total amount of transactions for all users';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $totalAmount = Transaction::sum('amount');
        $this->info('Total amount of transactions: ' . $totalAmount);
    }
}
