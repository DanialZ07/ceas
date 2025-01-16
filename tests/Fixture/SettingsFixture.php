<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SettingsFixture
 */
class SettingsFixture extends TestFixture
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
                'id' => '12cec85b-4ad8-44c5-85ac-eb5372bb2766',
                'system_name' => 'Lorem ipsum dolor sit amet',
                'system_abbr' => 'Lorem ipsum dolor sit amet',
                'system_slogan' => 'Lorem ipsum dolor sit amet',
                'organization_name' => 'Lorem ipsum dolor sit amet',
                'domain_name' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'notification_email' => 'Lorem ipsum dolor sit amet',
                'meta_title' => 'Lorem ipsum dolor sit amet',
                'meta_keyword' => 'Lorem ipsum dolor sit amet',
                'meta_subject' => 'Lorem ipsum dolor sit amet',
                'meta_copyright' => 'Lorem ipsum dolor sit amet',
                'meta_desc' => 'Lorem ipsum dolor sit amet',
                'timezone' => 'Lorem ipsum dolor sit amet',
                'author' => 'Lorem ipsum dolor sit amet',
                'site_status' => 1,
                'user_reg' => 1,
                'config_2' => 1,
                'config_3' => 1,
                'version' => 'Lorem ipsum dolor sit amet',
                'private_key_from_recaptcha' => 'Lorem ipsum dolor sit amet',
                'public_key_from_recaptcha' => 'Lorem ipsum dolor sit amet',
                'banned_username' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'telegram_bot_token' => 'Lorem ipsum dolor sit amet',
                'telegram_chatid' => 'Lorem ipsum dolor sit amet',
                'hcaptcha_sitekey' => 'Lorem ipsum dolor sit amet',
                'hcaptcha_secretkey' => 'Lorem ipsum dolor sit amet',
                'notification' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'notification_status' => 1,
                'notification_date' => '2024-02-15',
                'ribbon_title' => 'Lorem ipsum dolor ',
                'ribbon_link' => 'Lorem ipsum dolor sit amet',
                'ribbon_status' => 1,
                'created' => '2024-02-15 13:16:21',
                'modified' => '2024-02-15 13:16:21',
            ],
        ];
        parent::init();
    }
}
