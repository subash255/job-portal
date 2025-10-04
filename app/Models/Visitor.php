<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'url',
        'referer',
        'user_id',
        'visit_date'
    ];

    protected $casts = [
        'visit_date' => 'date'
    ];

    public static function recordVisit($request, $userId = null)
    {
        // Check if this IP + User Agent combination has already been recorded today
        $existingVisit = self::where('ip_address', $request->ip())
                            ->where('user_agent', $request->header('User-Agent'))
                            ->where('visit_date', Carbon::today())
                            ->exists();

        // Only record if no visit from this IP + User Agent today
        if (!$existingVisit) {
            try {
                self::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                    'url' => $request->fullUrl(),
                    'referer' => $request->header('referer'),
                    'user_id' => $userId,
                    'visit_date' => Carbon::today()
                ]);
                
                // Log successful tracking
                Log::info('Visitor recorded', [
                    'ip' => $request->ip(), 
                    'url' => $request->fullUrl(),
                    'user_agent' => substr($request->header('User-Agent'), 0, 50) . '...'
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to record visitor', ['error' => $e->getMessage()]);
            }
        } else {
            Log::info('Visitor already recorded today', [
                'ip' => $request->ip(), 
                'user_agent' => substr($request->header('User-Agent'), 0, 50) . '...'
            ]);
        }
    }

    public static function getTotalVisits()
    {
        return self::count();
    }

    public static function getTotalUniqueVisitors()
    {
        return self::distinct('ip_address')->count();
    }

    public static function getTodayVisits()
    {
        return self::where('visit_date', Carbon::today())->count();
    }

    public static function getTodayUniqueVisitors()
    {
        return self::where('visit_date', Carbon::today())->distinct('ip_address')->count();
    }

    public static function getVisitsLast30Days()
    {
        return self::where('visit_date', '>=', Carbon::now()->subDays(30))
                  ->selectRaw('visit_date, COUNT(*) as visits')
                  ->groupBy('visit_date')
                  ->orderBy('visit_date')
                  ->get();
    }

    public static function getUniqueVisitorsLast30Days()
    {
        return self::where('visit_date', '>=', Carbon::now()->subDays(30))
                  ->selectRaw('visit_date, COUNT(DISTINCT ip_address) as unique_visitors')
                  ->groupBy('visit_date')
                  ->orderBy('visit_date')
                  ->get();
    }
}
