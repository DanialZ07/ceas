<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserLogsFixture
 */
class UserLogsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'action' => 'Lorem ipsum dolor sit amet',
                'useragent' => 'Lorem ipsum dolor sit amet',
                'os' => 'Lorem ipsum dolor sit amet',
                'ip' => 'Lorem ipsum dolor sit amet',
                'host' => 'Lorem ipsum dolor sit amet',
                'referrer' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2024-02-23 04:26:09',
                'modified' => '2024-02-23 04:26:09',
            ],
        ];
        parent::init();
    }
}
