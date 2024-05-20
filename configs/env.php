<?php

return [
  'production' => [
      'host' => 'cinergie.be',
      'display_errors' => 1,
      'reporting' => 0
    ],

  'staging' => [
      'host' => 'cinergie.lareponse.org',
      'display_errors' => E_ALL & ~E_DEPRECATED & ~E_STRICT,
      'reporting' => 1
  ],

  'dev' => [
      'host' => 'dev.cinergie.be',
      'display_errors' => E_ALL,
      'reporting' => 1
    ]
];
