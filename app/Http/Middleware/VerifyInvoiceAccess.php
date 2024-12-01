<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class VerifyInvoiceAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $allowedInvoiceId = Session::get('allowed_invoice_id');
        $requestedInvoiceId = $request->route('id');

        if ($allowedInvoiceId != $requestedInvoiceId) {
            abort(403, 'Not Found');
        }

        return $next($request);
    }
}
