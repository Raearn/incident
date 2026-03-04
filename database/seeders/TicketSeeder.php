<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have at least one user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => bcrypt('password')]
        );

        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        $tickets = [
            [
                'title' => 'Server Outage in Data Center',
                'description' => 'The main production server is unresponsive. Multiple services are down.',
                'incident_date' => Carbon::now()->subHours(2),
                'type' => 'Network',
                'priority' => 'Critical',
                'status' => 'Open',
                'solution' => null,
                'reported_by' => $admin->id,
                'assigned_to' => $user->id,
            ],
            [
                'title' => 'Printer Jam on 2nd Floor',
                'description' => 'The HP LaserJet printer on the 2nd floor keeps jamming paper.',
                'incident_date' => Carbon::now()->subDays(1),
                'type' => 'Hardware',
                'priority' => 'Low',
                'status' => 'Open',
                'solution' => null,
                'reported_by' => $user->id,
                'assigned_to' => null,
            ],
            [
                'title' => 'Application Crash on Login',
                'description' => 'Users report the application crashes immediately after clicking the login button.',
                'incident_date' => Carbon::now()->subHours(5),
                'type' => 'Software',
                'priority' => 'High',
                'status' => 'In Progress',
                'solution' => null,
                'reported_by' => $user->id,
                'assigned_to' => $admin->id,
            ],
            [
                'title' => 'Email Access Issue',
                'description' => 'Unable to access Outlook web app. Getting a 503 error.',
                'incident_date' => Carbon::now()->subDays(2),
                'type' => 'Network',
                'priority' => 'Medium',
                'status' => 'Resolved',
                'solution' => 'Restarted the exchange services and verified connectivity.',
                'reported_by' => $admin->id,
                'assigned_to' => $user->id,
            ],
            [
                'title' => 'Phishing Email Report',
                'description' => 'Received a suspicious email asking for password reset. Forwarded for analysis.',
                'incident_date' => Carbon::now()->subDays(3),
                'type' => 'Security',
                'priority' => 'High',
                'status' => 'Closed',
                'solution' => 'Confirmed phishing attempt. Blocked sender domain and notified staff.',
                'reported_by' => $user->id,
                'assigned_to' => $admin->id,
            ],
            [
                'title' => 'Mouse not working',
                'description' => 'Wireless mouse is not connecting to the laptop even after battery replacement.',
                'incident_date' => Carbon::now()->subDays(4),
                'type' => 'Hardware',
                'priority' => 'Low',
                'status' => 'Open',
                'solution' => null,
                'reported_by' => $user->id,
                'assigned_to' => null,
            ],
            [
                'title' => 'VPN Connectivity Issues',
                'description' => 'Remote employees are experiencing frequent disconnections from the VPN.',
                'incident_date' => Carbon::now()->subHours(12),
                'type' => 'Network',
                'priority' => 'Medium',
                'status' => 'In Progress',
                'solution' => null,
                'reported_by' => $admin->id,
                'assigned_to' => $user->id,
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
