<?php

namespace Database\Seeders;

use App\Models\SupportCase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SupportCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cases = [
            [
                'requester_id' => 4,
                'agent_id' => 1,
                'status' => 'in_progress',
                'entry_date' => '2024-01-15 09:30:00',
                'closed_at' => null
            ],
            [
                'requester_id' => 5,
                'agent_id' => 2,
                'status' => 'finished',
                'entry_date' => '2024-01-14 14:20:00',
                'closed_at' => '2024-01-15 16:45:00'
            ],
            [
                'requester_id' => 7,
                'agent_id' => null,
                'status' => 'created',
                'entry_date' => '2024-01-16 08:15:00',
                'closed_at' => null
            ],
            [
                'requester_id' => 8,
                'agent_id' => 3,
                'status' => 'assigned',
                'entry_date' => '2024-01-15 11:45:00',
                'closed_at' => null
            ],
            [
                'requester_id' => 10,
                'agent_id' => 1,
                'status' => 'finished',
                'entry_date' => '2024-01-13 13:20:00',
                'closed_at' => '2024-01-14 15:30:00'
            ],
            [
                'requester_id' => 11,
                'agent_id' => 6,
                'status' => 'in_progress',
                'entry_date' => '2024-01-16 10:00:00',
                'closed_at' => null
            ],
            [
                'requester_id' => 12,
                'agent_id' => 9,
                'status' => 'finished',
                'entry_date' => '2024-01-12 16:30:00',
                'closed_at' => '2024-01-13 14:20:00'
            ],
            [
                'requester_id' => 4,
                'agent_id' => 2,
                'status' => 'in_progress',
                'entry_date' => '2024-01-16 09:15:00',
                'closed_at' => null
            ],
            [
                'requester_id' => 8,
                'agent_id' => null,
                'status' => 'created',
                'entry_date' => '2024-01-16 11:30:00',
                'closed_at' => null
            ],
            [
                'requester_id' => 5,
                'agent_id' => 3,
                'status' => 'assigned',
                'entry_date' => '2024-01-15 15:45:00',
                'closed_at' => null
            ],
            [
                'requester_id' => 7,
                'agent_id' => 6,
                'status' => 'finished',
                'entry_date' => '2024-01-14 10:20:00',
                'closed_at' => '2024-01-15 11:30:00'
            ],
            [
                'requester_id' => 10,
                'agent_id' => 9,
                'status' => 'in_progress',
                'entry_date' => '2024-01-16 08:45:00',
                'closed_at' => null
            ]
        ];

        foreach ($cases as $case) {
            SupportCase::create($case);
        }
    }
}
