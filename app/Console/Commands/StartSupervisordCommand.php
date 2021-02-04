<?php 

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Str;

class StartSupervisordCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'service:supervisor';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Running supervisor';
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
        $check = new Process(["service", "supervisor", "status"]);
        $check->run();

        $outp = $check->getOutput();
        if(Str::contains($outp,"not running")){

            $process = new Process(["service", "supervisor", "start"]);
            $process->run();
            if (!$process->isSuccessful()) {
                Log::error("cannot start command");
                throw new ProcessFailedException($process);
            }

            echo $process->getOutput();
        } else {
            echo "service already running\n";
        }

    }
    
   
}