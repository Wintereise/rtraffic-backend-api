<?php


namespace app\Http\Controllers;


class responseHandler
{
    public static function handle ($code, $data = false)
    {
        $messages = [
            400 => 'You have sent a malformed request.',
            404 => 'You tried to access a resource that does not exist.',
            403 => 'You tried to access a resource that you do not have authorization for.',
            500 => 'Internal Server Error, please wait some time before retrying your request.',
            401 => 'An invalid API token was sent. Please re-authenticate.',
            422 => 'Your request contains illegal parameter(s), please review.',
            200 => 'The requested operation was successfully completed.'
        ];

        $ret = [
            'status' => $code,
            'message' => $messages[$code]
        ];

        if (is_array($data))
            $ret['data'] = $data;

        return response()->json($ret, $code);
    }
}