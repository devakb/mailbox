<?php
namespace Devakb\Mailbox\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallComponentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailbox:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
        Artisan::call('vendor:publish --tag=initComponent');
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/Auth/stubs/routes.stub'),
            FILE_APPEND
        );
        return true;
    }
}
