<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CampusesFixture
 */
class CampusesFixture extends TestFixture
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
                'name' => 1,
                'status' => 1,
                'created' => '2025-01-15 20:49:41',
                'modified' => '2025-01-15 20:49:41',
            ],
        ];
        parent::init();
    }
}
