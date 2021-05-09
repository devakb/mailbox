<?php

namespace devakb\Mailbox\Tests;

use devakb\Mailbox\Facades\Mailbox;
use devakb\Mailbox\ServiceProvider;
use Orchestra\Testbench\TestCase;

class MailboxTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'mailbox' => Mailbox::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
