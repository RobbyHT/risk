<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Device::truncate();

        $csv = fopen(base_path("database/sql/devices_v1.csv"), "r");

        $firstline = true;

        while(($data = fgetcsv($csv, 2000, ",")) !== false) {
            if (!$firstline) {
                Device::create([
                    'code' => $data[1],
                    'name' => $data[2],
                ]);
            }

            $firstline = false;
        }

        fclose($csv);
    }
}
