<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/api/flights',
        '/api/flights/*',
        '/api/tickets',
        '/api/tickets/*',
        '/api/passengers',
        '/api/passengers/*',
        '/api/users',
        '/api/users/*',
        '/api/invoices',
        '/api/invoices/*',
        '/api/invoice-details',
        '/api/invoice-details/*',
        '/api/contact-infos',
        '/api/contact-infos/*',
        '/api/payers',
        '/api/payers/*',
        '/api/register',
        '/api/login',
        '/api/logout',
    ];
}
