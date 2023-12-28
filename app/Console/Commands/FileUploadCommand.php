<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FileUploadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:upload {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'file uploade to the drive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file');

        try {
            $this->uploadFile($file);
            $this->info('File uploaded successfully!');
        } catch (\Exception $e) {
            $this->error('File upload failed: ' . $e->getMessage());
        }
    }


    private function uploadFile($file)
    {
        $drive = 'public';
        $destinationPath = 'uploads';
        $filename = pathinfo($file, PATHINFO_FILENAME) . '.txt';

        $stream = fopen($file, 'r');
        Storage::disk($drive)->put($destinationPath . '/' . $filename, $stream);
        fclose($stream);

        $this->info('File uploaded successfully!');
    }


}

