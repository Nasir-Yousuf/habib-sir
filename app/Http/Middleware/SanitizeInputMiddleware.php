<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SanitizeInputMiddleware
{
    /**
     * Handle an incoming request and sanitize inputs to prevent Stored XSS and payload injections.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();

        // Recursively clean strings in request payload
        array_walk_recursive($input, function (&$value, $key) {
            if (is_string($value)) {
                // Don't modify passwords
                if (!in_array($key, ['password', 'password_confirmation'], true)) {
                    // Strip dangerous tags: script, iframe, object, embed, javascript: protocols
                    $value = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $value);
                    $value = preg_replace('/<iframe\b[^>]*>(.*?)<\/iframe>/is', '', $value);
                    $value = preg_replace('/javascript:/i', '', $value);
                    $value = preg_replace('/(on\w+)=("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $value);
                    $value = trim(strip_tags($value, '<p><br><b><strong><i><em><ul><ol><li><a><h3><h4><h5>'));
                }
            }
        });

        $request->merge($input);

        return $next($request);
    }
}
