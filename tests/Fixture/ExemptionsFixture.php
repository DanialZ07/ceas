<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ExemptionsFixture
 */
class ExemptionsFixture extends TestFixture
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
                'student_id' => 1,
                'faculty_id' => 1,
                'program_id' => 1,
                'semester_id' => 1,
                'campus_id' => 1,
                'matrix' => 'Lorem ipsum d',
                'ic_number' => 'Lorem ipsum dolor ',
                'kod_kursus_dipohon' => 'Lorem ip',
                'nama_kursus_dipohon' => 'Lorem ipsum dolor sit amet',
                'kod_terdahulu' => 'Lorem ip',
                'nama_kursus_terdahulu' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2025-01-15 20:52:24',
                'modified' => '2025-01-15 20:52:24',
            ],
        ];
        parent::init();
    }
}
