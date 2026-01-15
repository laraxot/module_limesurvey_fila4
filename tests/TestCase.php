<?php

declare(strict_types=1);

namespace Modules\Limesurvey\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Xot\Tests\CreatesApplication;
use Modules\Limesurvey\Providers\LimesurveyServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        /* @noinspection PhpUnusedParameterInspection */
        return [
            LimesurveyServiceProvider::class,
        ];
    }
}