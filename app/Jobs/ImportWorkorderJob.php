<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\WorkorderImport;
use Illuminate\Support\Facades\Log;

class ImportWorkorderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $userid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file,$userid)
    {
        $this->file = $file;
        $this->userid = $userid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("import excel ".$this->file);
        Excel::import(new WorkorderImport($this->file,$this->userid),$this->file);//->allOnQueue('ipa');
        //Excel::queueImport(new WorkorderImport($this->file,$this->userid))->queue($this->file)->allOnQueue('ipa');
        
        //Excel::import(new WorkorderImport, $this->file); 
        //unlink($this->file);
    }
}
