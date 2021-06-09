<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

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
        'regUser' => \App\Filters\RegisteredUserFilter::class,
        'guest' => \App\Filters\GuestFilter::class,
        'password' => \App\Filters\PasswordFilter::class
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'honeypot',
			// 'csrf',
		],
		'after'  => [
			'toolbar',
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
	public $filters = [
	    "regUser" => ['before' => ['Admin/*', 'Admin']],
        "guest" => ['before' => ['Admin/*', 'Admin', 'Map/*', 'Map', 'Journal/*', 'Journal', 'Badges/*', 'Badges', 'ChangePic/*', 'ChangePic',
            'CreateReview/*', 'CreateReview', 'Logout/*', 'Logout', 'Quiz/*', 'Quiz', 'ToGoList/*', 'ToGoList']],
        "password" => ['before' => ['Password', 'Password/index', 'Password/setPassword',
            'Password/validateQuestions', 'Password/validateAnswers', 'Password/getUser']]
    ];
}
