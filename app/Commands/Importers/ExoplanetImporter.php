<?php
/**
 * Description of ExoplanetImporter.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Commands\Importers;


use Illuminate\Console\Command;

class ExoplanetImporter extends Command
{

    protected $signature = 'import:exoplanets {--file= : File path}';

    protected $description = 'Import exoplanets from file';

    public function handle(): void
    {
        $file = $this->option('file');
        if (empty($file)) {
            $this->error('File path is required');
            return;
        }


        $this->info('Importing exoplanets from file: ' . $file);
    }

}
