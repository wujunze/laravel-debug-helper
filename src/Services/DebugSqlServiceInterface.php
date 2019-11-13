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

namespace WuJunze\LaravelDebugHelper\Services;

interface DebugSqlServiceInterface
{
    public function log($query, $bindings, $time);
}
