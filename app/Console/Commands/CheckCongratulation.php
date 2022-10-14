<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class CheckCongratulation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:com';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Europe/Kiev');
        $format='Happy B-day! :flag-ua::tada::cake: - %s'; 
        $rows = App::make('get_sheet_data');
        if(!$rows->count())
        {
            Log::channel('bot')->info('sheet without rows');
            return;
        };
        $send_data=$rows->map(function($item,$key){
            $dm='none';
            if(preg_match("/([\d]+)-([\d]+)-([\d]+)/",$item[1],$mutch))
            {
				$day=(strlen($mutch[1])==1)?'0'.$mutch[1]:$mutch[1];
				$month=(strlen($mutch[2])==1)?'0'.$mutch[2]:$mutch[2];
                $dm=$day.'-'.$month;
            }
            return ['name'=>$item[0],'date'=>$dm];
        })->where('date',date('d-m',time()));
        if(!$send_data->count())
        {
            Log::channel('bot')->info('not one birthday');
            return;
        }
        $send_data->each(function($item,$key) use($format) {
            $message=sprintf($format,$item['name']);
            Log::channel('slack')->info($message);
            Log::channel('bot')->info($message);
        });
    }
}
