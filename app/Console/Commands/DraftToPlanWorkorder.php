<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Draft;
use App\Models\Plan;

class DraftToPlanWorkorder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workorder:plan {--month=now}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Workorder draft to plan';

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
        $month = $this->option('month');
        
        $draft = Draft::whereNull('deleted_at')->get();
        $mytime = \Carbon\Carbon::now('Asia/Jakarta')->addMonthsNoOverflow()->firstOfMonth();
        if($month === "now")
            $mytime = \Carbon\Carbon::now('Asia/Jakarta')->firstOfMonth();

        $date_plan = $mytime->format('Y-m-d');
        echo "add to plan\n";
        foreach($draft as $value){
            echo $date_plan."\n";
            Plan::create([
                'draft_id'=>$value->id,
                'date_plan'=>$date_plan
            ]);
        }

        echo "done\n";
    }
}
