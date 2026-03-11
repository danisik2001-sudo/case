<?php

namespace App\Http\Middleware;

use Closure;

class MinifyHtml
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->headers->get('Content-Type') === 'text/html; charset=UTF-8') {
            $output = $response->getContent();

            $output = preg_replace(
                [
                    '/>\s+</',
                    '/\s+/',
                    '/<!--.*?-->/'
                ],
                [
                    '><',
                    ' ',
                    ''
                ],
                $output
            );

            $response->setContent($output);
        }

        return $response;
    }
}
