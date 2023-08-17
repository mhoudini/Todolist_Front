
<?php

$config = [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'charset' => getenv('DB_CHARSET') ?: 'UTF8',
    'dbname' => getenv('DB_NAME') ?: 'js',
    'userName' => getenv('DB_USER') ?: 'root',
    'pwd' => getenv('DB_PASSWORD') ?: '',
];
