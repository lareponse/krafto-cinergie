<?php

define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

$settings = array(
  'app' => [
		'name' => 'Cinergie',
		'production_host' => 'cinergie.be',
    'session_start_options' => ['session_name' => 'krafto-cinergie']

	],

  'locale' => [
    'json_path' => DOCUMENT_ROOT.'/cache/locale/user_interface_{LANGUAGE}.json',
    'cache_path' => DOCUMENT_ROOT.'/cache/locale',
    'fallback_lang' => 'fra'
  ],

	'default' => array(
		'language' => 'fra', // can't be iso 693-3 because of common.inc putenv('LANG='.$settings['default']['language']); & setlocale(LC_ALL, $settings['default']['language']);
		'timezone' => 'Europe/Brussels',
		'charset' => 'UTF-8',
		'max_idle_time' => 24*3600, // handles session expiration after some idle time (in seconds)
	),
	'filter' => array(
		// 'search_term' => '',
		// 'page' => 1,
		// 'time_window_start' => '-1 months',
		// 'time_window_stop' => '+1 month',
		// 'results_per_page' => '16',
	),

  'env' => require_once('env.php'),
  'api' => require_once('api.php')
);


$settings ['kortex'] = [
    'meta' => [
      'image' => '/public/assets/img/logo-cinergie.svg'
    ]
];


$server = require_once 'database.php'; // needed for LeMarchand wiring

$settings['HexMakina\LeMarchand\LeMarchand'] = [
  'wiring' => [
    'Psr\Log\LoggerInterface' =>  'HexMakina\LogLaddy\LogLaddy',
    'HexMakina\BlackBox\RouterInterface' => 'HexMakina\Hopper\Hopper',
    'HexMakina\BlackBox\TemplateInterface' => 'League\Plates\Engine',
    'HexMakina\BlackBox\Auth\OperatorInterface' => 'HexMakina\kadro\Auth\Operator',
    'HexMakina\BlackBox\Database\DatabaseInterface' =>  'HexMakina\Crudites\Database',
    'HexMakina\BlackBox\Database\TracerInterface' => 'HexMakina\Tracer\Tracer',
    'HexMakina\BlackBox\Database\ConnectionInterface' =>  ['HexMakina\Crudites\Connection', $server['dsn'], $server['user'], $server['pass'], []],
    'HexMakina\BlackBox\StateAgentInterface' => ['HexMakina\StateAgent\Smith', 'getInstance', $settings['app']['session_start_options']]
  ],
  'cascade' => [
    '\\App\\',
    '\\HexMakina\\kadro\\'
  ]
];

$settings['TracerInterface']['tracing_table'] = 'kadro_action_logger';

$settings['template'] = [
  'baseDirectory' => DOCUMENT_ROOT.'/app/Views',
  'extraDirectories' => [
    'Open' => DOCUMENT_ROOT.'/app/Views/Open',
    'Secret' => DOCUMENT_ROOT.'/app/Views/Secret',
  ],
  
  'extensions' => [
    '\App\Views\CinergieStreamlineIcons',
    '\App\Views\CinergieDashlyComponents'
  ],

  'registerClass' => [
    'Marker' => '\\HexMakina\\Marker\\Marker',
    'HTML' => '\\HexMakina\\Marker\\Marker',
    'DOM' => '\\HexMakina\\Marker\\Marker',

    'Form' => '\\HexMakina\\Marker\\Form',
    'TableToForm' => '\\HexMakina\\kadro\\TableToForm',
    
    'Lezer' => '\\HexMakina\\Lezer\\Lezer',
  ]
];

$settings['Constructor'] = [
    'HexMakina\Hopper\Hopper' => [
      'route_home' => 'Open\\Home::home',
      'web_base' => '/',
      'file_root' => DOCUMENT_ROOT.'/'
    ],
    'League\Plates\Engine' => [
      'directory' => $settings['template']['baseDirectory'],
      'fileExtension' => 'php'
    ]
];

$settings['folders'] = [
  'public' => DOCUMENT_ROOT.'/public/',
  'images' => DOCUMENT_ROOT.'/public/images',
  'assets' => DOCUMENT_ROOT.'/public/assets/'
];

$settings['urls'] = [
  'public' => '/public/',
  'images' => '/public/images',
  'assets' => 'public/assets/'
];

$settings['images'] = [
  'allowedMIMETypes' => [
    'image/jpeg',
    'image/png',
    'image/gif',
    'image/webp',
    'image/tiff',
    'image/bmp',
    'image/svg+xml'
  ]
];

$settings['import']['directory'] = DOCUMENT_ROOT.'/import/';
$settings['export']['directory'] = DOCUMENT_ROOT.'/exports/';
$settings['export']['csv_filepath'] = './exports/export.csv';
$settings['export']['csv_filepath'] = 'php://output'; // sends it to the browser for download

return $settings;
