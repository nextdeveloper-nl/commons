<?php

namespace NextDeveloper\Commons\Tests\Helpers;

use NextDeveloper\Commons\Helpers\DomainsHelper;
use PHPUnit\Framework\TestCase;

class DomainHelperTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_is_fqdn(): void
    {
        self::assertTrue(DomainsHelper::isFQDN('nextdeveloper.com'));
        self::assertFalse(DomainsHelper::isFQDN('nextdeveloper'));
    }
}