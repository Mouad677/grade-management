<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class LogController extends Controller
{
    public function index()
    {
        $logPath = storage_path('logs/laravel.log');
        $logs = [];
        
        if (File::exists($logPath)) {
            $content = File::get($logPath);
            $lines = explode("\n", $content);
            
            // Process logs in reverse order (newest first)
            $lines = array_reverse($lines);
            
            // Take only the last 100 entries
            $lines = array_slice($lines, 0, 100);
            
            // Process each line
            foreach ($lines as $line) {
                if (empty(trim($line))) continue;
                
                // Try to extract date and message
                if (preg_match('/^\[(.*?)\]/', $line, $matches)) {
                    $dateStr = $matches[1];
                    $message = substr($line, strlen($matches[0]));
                    
                    // Try to parse the date
                    try {
                        $date = Carbon::parse($dateStr);
                        $formattedDate = $date->format('d/m/Y H:i:s');
                    } catch (\Exception $e) {
                        $formattedDate = 'N/A';
                    }
                    
                    $logs[] = [
                        'date' => $formattedDate,
                        'message' => trim($message)
                    ];
                } else {
                    // If no date found, just add the line as is
                    $logs[] = [
                        'date' => 'N/A',
                        'message' => trim($line)
                    ];
                }
            }
        }

        return view('admin.logs.index', compact('logs'));
    }

    public function download()
    {
        $logPath = storage_path('logs/laravel.log');
        
        if (!File::exists($logPath)) {
            return back()->with('error', 'No log file found.');
        }

        return Response::download($logPath, 'laravel.log');
    }
} 