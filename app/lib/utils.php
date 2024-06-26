<?php

// response success
if (!function_exists('responseSuccess')) {
    function responseSuccess(string $message = 'Berhasil Menyimpan Data')
    {
        return response()->json([
            'status'    => 'success',
            'message'   => $message
        ]);
    }
}

// response error
if (!function_exists('responseError')) {
    function responseError(string | Exception $th)
    {
        $message = 'Terjadi kesalahanm, silahkan coba beberapa saat lagi';
        if ($th instanceof \Exception) {
            if (config('app.debug')) {
                $message = $th->getMessage();
                $message .= ' in line ' .  $th->getLine() . ' at ' . $th->getFile();
                $data = $th->getTrace();
            }
        } else {
            $message = $th;
        }

        return response()->json([
            'status'    => 'error',
            'message'   => $message,
            'data'      => $data ?? null,
        ], 500);
    }
}
