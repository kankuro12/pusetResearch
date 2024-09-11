<?php

namespace App\Console\Commands;

use App\Http\Controllers\admin\BookController;
use Illuminate\Console\Command;

class RebuildCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:rebuild';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new BookController())->render();
    }
}
