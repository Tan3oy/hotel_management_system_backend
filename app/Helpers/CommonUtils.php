<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Log;

trait CommonUtils
{
    public function returnSuccess($code,$data)
    {
        return response()->json([
            'success' =>true,
            'status_code' => $code,
            'message' => is_array($data) ? $data : [$data]
        ]);
    }
    public function returnFail($code,$data)
    {
        return response()->json([
            'success' =>true,
            'status_code' => $code,
            'message' => is_array($data) ? $data : [$data]
        ]);
    }
        public function log($data, $label = 'DEBUG')
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

        $file = $trace['file'] ?? 'unknown_file';
        $line = $trace['line'] ?? 'unknown_line';

        if (is_array($data) || is_object($data)) {

            if (is_object($data) && method_exists($data, 'toArray')) {
                $data = $data->toArray();
            }

            $output = json_encode($data, JSON_PRETTY_PRINT);

        } else {
            $output = $data; // keep string without quotes
        }

        Log::info("[$label] $file:$line\n$output");
    }
}