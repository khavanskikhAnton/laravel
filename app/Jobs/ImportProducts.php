<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = 'storage\app\public\products\importProducts.csv';
        $file = fopen($path, 'r');
 
        $i = 0;
        $insert = [];
        while ($row = fgetcsv($file, 1000, ';')) {
        
            if ($i++ == 0) {
                $bom = pack('H*', 'EFBBBF'); //Создает запись "невидимого символа", который создает Excel.
                $row = preg_replace("/^$bom/", '', $row); //С помощью регулярного выражения ищет "символ" и заменяте его на пустое значение, после чего записывает результат в $row.

                $columns = $row;
                continue;
            }

            $data = array_combine($columns, $row);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $insert [] = $data;
        }

        Product::insert($insert); 
    }
}