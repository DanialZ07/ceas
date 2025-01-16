<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Exemption Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $faculty_id
 * @property int $program_id
 * @property int $semester_id
 * @property int $campus_id
 * @property string $matrix
 * @property string $ic_number
 * @property string $kod_kursus_dipohon
 * @property string $nama_kursus_dipohon
 * @property string $kod_terdahulu
 * @property string $nama_kursus_terdahulu
 * @property int $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Faculty $faculty
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\Campus $campus
 */
class Exemption extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'student_id' => true,
        'faculty_id' => true,
        'program_id' => true,
        'semester_id' => true,
        'campus_id' => true,
        'matrix' => true,
        'ic_number' => true,
        'kod_kursus_dipohon' => true,
        'nama_kursus_dipohon' => true,
        'kod_terdahulu' => true,
        'nama_kursus_terdahulu' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'student' => true,
        'faculty' => true,
        'program' => true,
        'campus' => true,
    ];
}
