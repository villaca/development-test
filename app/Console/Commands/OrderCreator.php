<?php

namespace App\Console\Commands;

use App\Order;
use App\RandomOrder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class OrderCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create orders with random products';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orderList = [];
        //$orderList = Cache::get("orderList");

        Order::generateRandomOrder();
        //Cache::put("orderList", $order, 600);
    }
}
