<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExemptionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExemptionsTable Test Case
 */
class ExemptionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExemptionsTable
     */
    protected $Exemptions;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Exemptions',
        'app.Students',
        'app.Faculties',
        'app.Programs',
        'app.Campuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Exemptions') ? [] : ['className' => ExemptionsTable::class];
        $this->Exemptions = $this->getTableLocator()->get('Exemptions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Exemptions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ExemptionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ExemptionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
