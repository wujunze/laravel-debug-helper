<?php declare(strict_types=1);
/**
 *
 * This file is part of the package.
 *
 * (c) Panda <itwujunze@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WuJunze\LaravelDebugHelper\Services\Middlewares;

use Closure;
use Illuminate\Http\Request;
use WuJunze\LaravelDebugHelper\Services\LogProfile;
use WuJunze\LaravelDebugHelper\Services\LogWriter;

class HttpLogger
{
    protected $logProfile;
    protected $logWriter;

    public function __construct(LogProfile $logProfile, LogWriter $logWriter)
    {
        $this->logProfile = $logProfile;
        $this->logWriter = $logWriter;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->logProfile->shouldLogRequest($request)) {
            $this->logWriter->logRequest($request);
        }

        return $next($request);
    }
}
