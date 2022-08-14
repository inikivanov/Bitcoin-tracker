<?php

namespace App\Console\Commands;

use App\Models\Bitfinex;
use Illuminate\Console\Command;
use App\Services\ChartService;
use App\Repositories\ChartRepository;
use App\Services\NotifySubscribersService;

class ApiDataNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:data-notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrive data from api Bitfinex and check to notify subscribers';

    
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $chartRepository = new ChartRepository(new Bitfinex);
        $chartService = new ChartService;
        $notifyService = new NotifySubscribersService;

        $chartData = json_decode($chartService->getData(), true);

        $msg = '';
        if($chartRepository->insertChart($chartData))
        {
            $msg = 'Successfully insert new chart row in bitfinex table.';
        }  
        if(!empty($msg)){
            $msg .= ' ';
        }
        if($notifyService->checkAndNotify($chartData))
        {
            $msg .= 'Notify Subscriber(s) successfully.';
        } 
        if(empty($msg)){
            $msg = 'Some is Wrong';
        }
        
        $this->info($msg);
    }
   
}
