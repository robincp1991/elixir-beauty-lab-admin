<?php

$appUrl = rtrim(config('app.url'), '/');

$host = parse_url($appUrl, PHP_URL_HOST);
$scheme = parse_url($appUrl, PHP_URL_SCHEME);

return [
    'admin' => "{$scheme}://admin.{$host}",
    'api' => "{$scheme}://api.{$host}",
];
