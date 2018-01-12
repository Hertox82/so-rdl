<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class ReadIstatXlS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xlsIstat:read {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command read xlsIstatFile and transform in json file';

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
        $fileName = $this->argument('file');

        if(!is_null($fileName)) {

        }
    }
}
