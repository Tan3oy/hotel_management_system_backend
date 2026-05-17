<?php
namespace App\Helpers;

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
}