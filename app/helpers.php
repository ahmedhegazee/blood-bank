<?php

function jsonResponse($status, $message, $data = null)
{
    $response = [
        'status' => $status,
        'message' => $message,
        'data' => $data
    ];
    return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
}
