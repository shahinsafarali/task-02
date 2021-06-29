<?php

namespace App\Jobs;

use App\Services\EmployeeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessEmployees implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var UploadedFile
     */
    private $filePath;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fullPath = Storage::path($this->filePath);

        $xml = new \XMLReader();

        $data = [];

        try {
            $xml->open($fullPath);

            while ($xml->read()) {
                while($xml->name === 'department')
                {
                    $node = new \SimpleXMLElement($xml->readOuterXml());

                    $array = json_decode(json_encode($node), true);

                    $data[] = [
                        'department' => $array['@attributes']['Name'],
                        'employees' =>  $array['employee']
                    ];

                    $xml->next('department');
                }
            }
        }catch (\Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        EmployeeService::importEmployees($data);
    }
}
