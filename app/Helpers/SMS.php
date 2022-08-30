<?php

function SMSCUrl($phone, $message = "")
{

    $url = env('SMS_API');
    $data = [
        "api_key" => env('SMS_API_KEY'),
        "type" => "text",
        "contacts" => "$phone",
        "senderid" => "8809601000936",
        "msg" => "$message",
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function send_sms()
{
    SMSCUrl("8801712183691", "Hello World");
}
