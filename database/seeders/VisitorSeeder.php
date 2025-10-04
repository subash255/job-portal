<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visitor;
use Carbon\Carbon;

class VisitorSeeder extends Seeder
{
    public function run()
    {
        // Generate sample visitor data for the last 30 days
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            // Generate random number of visitors for each day (between 5-50)
            $visitorsCount = rand(5, 50);
            
            for ($j = 0; $j < $visitorsCount; $j++) {
                Visitor::create([
                    'ip_address' => $this->generateRandomIP(),
                    'user_agent' => $this->getRandomUserAgent(),
                    'url' => $this->getRandomUrl(),
                    'referer' => $this->getRandomReferer(),
                    'user_id' => null,
                    'visit_date' => $date->format('Y-m-d'),
                    'created_at' => $date->addMinutes(rand(0, 1439)), // Random time within the day
                    'updated_at' => $date
                ]);
            }
        }
    }

    private function generateRandomIP()
    {
        return rand(1, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(1, 255);
    }

    private function getRandomUserAgent()
    {
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15'
        ];
        return $userAgents[array_rand($userAgents)];
    }

    private function getRandomUrl()
    {
        $urls = [
            'http://localhost:8000/',
            'http://localhost:8000/jobs',
            'http://localhost:8000/about',
            'http://localhost:8000/contact',
            'http://localhost:8000/job-detail/1',
            'http://localhost:8000/login',
            'http://localhost:8000/register'
        ];
        return $urls[array_rand($urls)];
    }

    private function getRandomReferer()
    {
        $referers = [
            'https://google.com',
            'https://facebook.com',
            'https://linkedin.com',
            'https://twitter.com',
            null
        ];
        return $referers[array_rand($referers)];
    }
}