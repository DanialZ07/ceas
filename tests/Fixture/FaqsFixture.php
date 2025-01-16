<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FaqsFixture
 */
class FaqsFixture extends TestFixture
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
                'category' => 'Lorem ipsum dolor sit amet',
                'question' => 'Lorem ipsum dolor sit amet',
                'answer' => 'Lorem ipsum dolor sit amet',
                'slug' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2024-02-15 12:09:53',
                'modified' => '2024-02-15 12:09:53',
            ],
        ];
        parent::init();
    }
}
