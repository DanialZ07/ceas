<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $matrix
 * @property int $faculty_id
 * @property int $program_id
 * @property int $campus_id
 * @property int $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Faculty $faculty
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\Campus $campus
 * @property \App\Model\Entity\Exemption[] $exemptions
 */
class Student extends Entity
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
        'name' => true,
        'email' => true,
        'phone' => true,
        'matrix' => true,
        'faculty_id' => true,
        'program_id' => true,
        'campus_id' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'faculty' => true,
        'program' => true,
        'campus' => true,
        'exemptions' => true,
    ];
}
