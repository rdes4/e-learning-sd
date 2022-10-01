<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use App\Filters\AdminAuthFilter;
use App\Filters\GuruAuthFilter;
use App\Filters\SiswaAuthFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'adminauthfilter' => AdminAuthFilter::class,
        'guruauthfilter' => GuruAuthFilter::class,
        'siswaauthfilter' =>SiswaAuthFilter::class
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'adminauthfilter' => ['except' => [
                    'auth', 'auth/*',
                ]
            ],
            'guruauthfilter' => ['except' => [
                    'auth', 'auth/*',
                ]
            ],
            'siswaauthfilter' => ['except' => [
                    'auth', 'auth/*'
                ]
            ]
            // 'honeypot',
            // 'csrf',
        ],
        'after' => [
            'toolbar',
            'adminauthfilter' => ['except' => [
                    'siswa', 'siswa/*',
                    'guru', 'guru/*',
                    'kelas', 'kelas/*',
                    'mapel', 'mapel/*',
                    '/',
                ]
            ],
            'guruauthfilter' => ['except' => [
                'detailguru', 'detailguru/*', '/'
            ]],
            'siswaauthfilter' => ['except' => [
                'detailsiswa', 'detailsiswa/*', '/'
            ]]

            // 'honeypot',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
