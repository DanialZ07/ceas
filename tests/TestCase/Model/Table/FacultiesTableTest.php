<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FacultiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FacultiesTable Test Case
 */
class FacultiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FacultiesTable
     */
    protected $Faculties;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Faculties',
        'app.Exemptions',
        'app.Students',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Faculties') ? [] : ['className' => FacultiesTable::class];
        $this->Faculties = $this->getTableLocator()->get('Faculties', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Faculties);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FacultiesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
