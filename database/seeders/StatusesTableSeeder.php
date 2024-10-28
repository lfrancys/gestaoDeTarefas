<?php

namespace Database\Seeders;

use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $statuses = [
            [
                'name' => 'in_progress',
                'description' => 'In Progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'pending',
                'description' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'completed',
                'description' => 'Completed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'overdue',
                'description' => 'Overdue',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'archived',
                'description' => 'Archived',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($statuses as $status) {
            Status::firstOrCreate($status);
        }
    }
}
