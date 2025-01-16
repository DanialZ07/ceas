<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UserLogsComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\UserLogsComponent Test Case
 */
class UserLogsComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\UserLogsComponent
     */
    protected $UserLogs;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->UserLogs = new UserLogsComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UserLogs);

        parent::tearDown();
    }
}
