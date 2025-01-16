<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentsFixture
 */
class StudentsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor ',
                'matrix' => 'Lorem ipsum d',
                'faculty_id' => 1,
                'program_id' => 1,
                'campus_id' => 1,
                'status' => 1,
                'created' => '2025-01-15 20:54:36',
                'modified' => '2025-01-15 20:54:36',
            ],
        ];
        parent::init();
    }
}
