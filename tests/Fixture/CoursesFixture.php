<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoursesFixture
 */
class CoursesFixture extends TestFixture
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
                'code' => 'Lorem ip',
                'name' => 'Lorem ipsum dolor sit amet',
                'credits' => 1,
                'status' => 1,
                'created' => '2025-01-15 20:51:28',
                'modified' => '2025-01-15 20:51:28',
            ],
        ];
        parent::init();
    }
}
