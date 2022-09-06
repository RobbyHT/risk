<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use App\Models\Device;
use App\Models\DeviceExamItem;

class DeviceExamItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeviceExamItem::truncate();
        
        $csv = fopen(base_path("database/sql/devices_items.csv"), "r");

        $firstline = true;

        while(($data = fgetcsv($csv, 2000, ",")) !== false) {
            if (!$firstline) {
                DeviceExamItem::create([
                    'device_id' => $data[1],
                    'accept' => trim($data[2]),
                    'exam_item' => trim($data[5]),
                    'accept_min' => strlen($data[3]) ? $data[3] : null,
                    'accept_max' => strlen($data[4]) ? $data[4] : null,
                    'accept_unit' => trim($data[7]),
                    'desc' => trim($data[6]),
                ]);
            }

            $firstline = false;
        }

        fclose($csv);
    }
}
