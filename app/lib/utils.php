<?php

if (!function_exists('responseSuccess')) {
    function responseSuccess(string $message = 'Berhasil Menyimpan Data')
    {
        return response()->json([
            'status'    => 'success',
            'message'   => $message
        ]);
    }
}
