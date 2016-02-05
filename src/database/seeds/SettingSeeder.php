<?php

namespace Mc388\SimpleCms\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Mc388\SimpleCms\App\Models\Setting;

/**
 * Class SettingSeeder
 */
class SettingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        Setting::firstOrCreate(
            [
                'website_title' => 'SimpleCMS',
                'google_analytics_id' => '',
            ]
        );
    }
}
