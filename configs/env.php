<?php
$mysql_dsn = 'mysql:host=%s;port=%d;dbname=%s;charset=%s';

return [
  'production' => [
    'host' => 'cinergie.be',
    'display_errors' => 0,
    'reporting' => 0,
    'database' => [
      'dsn' => sprintf($mysql_dsn, 'localhost', 3306, 'cinergie', 'utf8'),
      'user' => 'cinergie',
      'pass' => 'a6/12_zhTR!Ytl)U'
    ]
  ],

  'staging' => [
    'host' => 'cinergie.lareponse.net',
    'display_errors' => E_ALL & ~E_DEPRECATED,
    'reporting' => 1,
    'database' => [
      'dsn' => sprintf($mysql_dsn, 'localhost', 3306, 'cinergie', 'utf8'),
      'user' => 'cinergie',
      'pass' => 'a6/12_zhTR!Ytl)U'
    ]
  ],

  'dev' => [
    'host' => 'dev.cinergie.be',
    'display_errors' => E_ALL,
    'reporting' => 1,
    'database' => [
      'dsn' => sprintf($mysql_dsn, 'localhost', 3306, 'cinergie', 'utf8'),
      'user' => 'cinergie',
      'pass' => 'a6/12_zhTR!Ytl)U'
    ]
  ]
];
