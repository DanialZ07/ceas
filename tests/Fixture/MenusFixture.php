<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MenusFixture
 */
class MenusFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'menus';
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
                'parent_id' => 1,
                'lft' => 1,
                'rght' => 1,
                'level' => 1,
                'icon' => 'Lorem ipsum dolor sit amet',
                'controller' => 'Lorem ipsum dolor sit amet',
                'action' => 'Lorem ipsum dolor sit amet',
                'target' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'url' => 'Lorem ipsum dolor sit amet',
                'prefix' => 'Lorem ipsum dolor sit amet',
                'auth' => 1,
                'admin' => 1,
                'active' => 1,
                'disabled' => 1,
                'divider_before' => 1,
                'parent_separator' => 1,
                'division' => 1,
            ],
        ];
        parent::init();
    }
}
