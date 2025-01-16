<?php
echo $this->Html->css('prism');
echo $this->Html->script('prism');

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$checkConnection = function (string $name) {
	$error = null;
	$connected = false;
	try {
		ConnectionManager::get($name)->getDriver()->connect();
		// No exception means success
		$connected = true;
	} catch (Exception $connectionError) {
		$error = $connectionError->getMessage();
		if (method_exists($connectionError, 'getAttributes')) {
			$attributes = $connectionError->getAttributes();
			if (isset($attributes['message'])) {
				$error .= '<br />' . $attributes['message'];
			}
		}
		if ($name === 'debug_kit') {
			$error = 'Try adding your current <b>top level domain</b> to the
                <a href="https://book.cakephp.org/debugkit/5/en/index.html#configuration" target="_blank">DebugKit.safeTld</a>
            config and reload.';
			if (!in_array('sqlite', \PDO::getAvailableDrivers())) {
				$error .= '<br />You need to install the PHP extension <code>pdo_sqlite</code> so DebugKit can work properly.';
			}
		}
	}

	return compact('connected', 'error');
};

if (!Configure::read('debug')) :
	throw new NotFoundException(
		'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
	);
endif;
?>

<h1 class="m-0 me-2 page_title">Re-CRUD Documentation</h1>
<small class="text-muted"><?php echo $system_name; ?></small>

<style>
	.resp-container {
		position: relative;
		overflow: hidden;
		padding-top: 56.25%;
	}

	.resp-iframe {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		border: 0;
	}
</style>



<div class="row">
	<div class="col-md-3">
		<div class="card bg-body-tertiary border-0 shadow">
			<div class="card-body text-body-secondary">

				INITIAL CONFIGURATION
				<ul>
					<li><?php echo $this->Html->link('Basic Requirements', '#a1', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Clone Repository', '#a2', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Database Configuration', '#a3', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Database Migration', '#a4', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Database Data Seeding', '#a5', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Email Configuration', '#a6', ['class' => '']); ?></li>
				</ul>


				CRUD OPERATION
				<ul>
					<li><?php echo $this->Html->link('Change Directory', '#b1', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Generate CRUD', '#b2', ['class' => '']); ?></li>
				</ul>

				AUTHENTICATION &amp; AUTHORIZATION
				<ul>
					<li><?php echo $this->Html->link('Default Auth Information', '#c1', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Allow Unauthorized Page', '#c2', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Print Auth Info', '#c3', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Conditional Checking', '#c4', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Capture User ID', '#c5', ['class' => '']); ?></li>
				</ul>

				SEARCH
				<ul>
					<li><?php echo $this->Html->link('Search Manager', '#d1', ['class' => '']); ?></li>
				</ul>

				FORM AND OTHERS
				<ul>
					<li><?php echo $this->Html->link('Button Style', '#e1', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Card', '#e2', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Link', '#e3', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Image', '#e4', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Date Time Format', '#e5', ['class' => '']); ?></li>
				</ul>

				PDF Related
				<ul>
					<li><?php echo $this->Html->link('PDF Controller', '#f1', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('PDF FileName', '#f2', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('PDF Template', '#f3', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('PDF Download Link', '#f4', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Image in PDF', '#f5', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('External CSS in PDF', '#f6', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Save PDF to Server', '#f7', ['class' => '']); ?></li>
					<li><?php echo $this->Html->link('Email Saved PDF as Email Attachment', '#f8', ['class' => '']); ?></li>
				</ul>

				META TAG
				<ul>
					<li><?php echo $this->Html->link('Customize Meta Tag', '#g1', ['class' => '']); ?></li>
				</ul>
			</div>
		</div>

	</div>
	<div class="col-md-9">

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Basic Requirements</div>
				<div class="tricolor_line mb-3"></div>
				<?php Debugger::checkSecurityKeys(); ?>
				<div class="row">
					<div class="col">
						Environment:<br>
						<ul class="fa-ul">
							<?php if (version_compare(PHP_VERSION, '7.2.0', '>=')) : ?>
								<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your version of PHP is 7.2.0 or higher (detected <?php echo PHP_VERSION ?>).</li>
							<?php else : ?>
								<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your version of PHP is too low. You need PHP 7.2.0 or higher to use CakePHP (detected <?php echo PHP_VERSION ?>).</li>
							<?php endif; ?>

							<?php if (extension_loaded('mbstring')) : ?>
								<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your version of PHP has the mbstring extension loaded.</li>
							<?php else : ?>
								<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your version of PHP does NOT have the mbstring extension loaded.</li>
							<?php endif; ?>

							<?php if (extension_loaded('openssl')) : ?>
								<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your version of PHP has the openssl extension loaded.</li>
							<?php elseif (extension_loaded('mcrypt')) : ?>
								<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your version of PHP has the mcrypt extension loaded.</li>
							<?php else : ?>
								<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your version of PHP does NOT have the openssl or mcrypt extension loaded.</li>
							<?php endif; ?>

							<?php if (extension_loaded('intl')) : ?>
								<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your version of PHP has the intl extension loaded.</li>
							<?php else : ?>
								<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your version of PHP does NOT have the intl extension loaded.</li>
							<?php endif; ?>
						</ul>
					</div>
					<div class="col">
						Filesystem:<br>
						<ul class="fa-ul">
							<?php if (is_writable(TMP)) : ?>
								<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your tmp directory is writable.</li>
							<?php else : ?>
								<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your tmp directory is NOT writable.</li>
							<?php endif; ?>

							<?php if (is_writable(LOGS)) : ?>
								<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your logs directory is writable.</li>
							<?php else : ?>
								<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your logs directory is NOT writable.</li>
							<?php endif; ?>

							<?php $settings = Cache::getConfig('_cake_core_'); ?>
							<?php if (!empty($settings)) : ?>
								<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> The <em><?php echo $settings['className'] ?>Engine</em> is being used for core caching. To change the config edit config/app.php</li>
							<?php else : ?>
								<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your cache is NOT working. Please check the settings in config/app.php</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<hr />
				<div class="row">
					<div class="col">
						Database:<br>
						<?php
						$checkConnection = function (string $name) {
							$error = null;
							$connected = false;
							try {
								ConnectionManager::get($name)->getDriver()->connect();
								// No exception means success
								$connected = true;
							} catch (Exception $connectionError) {
								$error = $connectionError->getMessage();
								if (method_exists($connectionError, 'getAttributes')) {
									$attributes = $connectionError->getAttributes();
									if (isset($attributes['message'])) {
										$error .= '<br />' . $attributes['message'];
									}
								}
								if ($name === 'debug_kit') {
									$error = 'Try adding your current <b>top level domain</b> to the
                <a href="https://book.cakephp.org/debugkit/5/en/index.html#configuration" target="_blank">DebugKit.safeTld</a>
            config and reload.';
									if (!in_array('sqlite', \PDO::getAvailableDrivers())) {
										$error .= '<br />You need to install the PHP extension <code>pdo_sqlite</code> so DebugKit can work properly.';
									}
								}
							}

							return compact('connected', 'error');
						};

						if (!Configure::read('debug')) :
							throw new NotFoundException(
								'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
							);
						endif;

						?>
						<?php
						$result = $checkConnection('default');
						?>
						<ul class="fa-ul">
							<?php if ($result['connected']) : ?>
								<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Re-CRUD is able to connect to the database.</li>
							<?php else : ?>
								<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Re-CRUD is NOT able to connect to the database.<br /><?php echo $errorMsg ?></li>
							<?php endif; ?>
						</ul>
					</div>
					<div class="col">
						Debugkit:<br>
						<ul class="fa-ul">
							<?php if (Plugin::isLoaded('DebugKit')) : ?>
								<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> DebugKit is loaded.</li>
							<?php else : ?>
								<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> DebugKit is NOT loaded. You need to either install pdo_sqlite, or define the "debug_kit" connection name.</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>

			</div>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Initial Setup</div>
				<div class="tricolor_line mb-3"></div>
				<div class="fw-bold" id="a2">Clone Repository</div>
				<div id="a2">
					Clone Re-CRUD using composer:<br />
					<pre class="border"><code class="language-html line-numbers">composer create-project recrud/recrud</code></pre>
					or
					<br />
					Clone Re-CRUD using git:<br />
					<pre class="border"><code class="language-html line-numbers">git clone https://github.com/Asyraf-wa/recrud.git</code></pre>
				</div>
				<br />
				<div class="fw-bold" id="a3">Database</div>
				<div id="a3">
					Rename file <kbd>app_local_example.php</kbd> to <kbd>app_local.php</kbd> in config folder
					<br />
					Create database in <kbd>phpmyadmin</kbd>
					<br />
					Configure database:
					<br />
					<pre class="border"><code class="language-php line-numbers">
'Datasources' => [
	'default' => [
		'host' => 'localhost',
		//'port' => 'non_standard_port_number',
		'username' => 'root',
		'password' => '',
		'database' => 'recrud',
		'url' => env('DATABASE_URL', null),
	],
]
					</code></pre>
				</div>
				<br />
				<div class="fw-bold" id="a4">Database Migration</div>
				<divid="a4">
					Database migration
					<pre class="border"><code class="language-html line-numbers">bin/cake migrations migrate</code></pre>
					</divid=>
					<br />
					<div class="fw-bold" id="a5">Database Seeding</div>
					<div id="a5">
						Database seeding
						<pre class="border"><code class="language-html line-numbers">bin/cake migrations seed</code></pre>
					</div>
					<br />
					<div class="fw-bold" id="a6">Email Configuration</div>
					<div id="a6">
						open <kbd>app_local.php</kbd> and add the following SMTP email configuration:
						<pre class="border"><code class="language-php line-numbers">
'EmailTransport' => [
	'smtp' => [
		'host' => 'YourHost',
		'port' => 25,
		'username' => 'emailUsername',
		'password' => 'emailPassword',
		'className' => 'Smtp',
		'client' => null,
		'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
	],
],
					</code></pre>

					</div>
			</div>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">CRUD Operation</div>
				<div class="tricolor_line mb-3"></div>
				<div class="fw-bold" id="b1">Change Directory</div>
				<div id="b1">
					Change to the target directory. Depend on your webserver directory. This is the example of XAMPP directory installed in drive C, Windows environment:
					<pre class="border"><code class="language-html line-numbers">cd c:/xampp/htdocs</code></pre>
					If using WAMP 64bit, installed in drive C, windows environment, the directory is:
					<pre class="border"><code class="language-html line-numbers">cd c:/wamp64/htdocs</code></pre>
					To create CRUD, the directory should target the bin folder in the root directory eg:<br />
					<em>Note: You can rename the recrud folder according to your system abbreviation.</em>
					<pre class="border"><code class="language-html line-numbers">cd c:/wamp64/htdocs/recrud/bin</code></pre>
				</div>

				<div class="fw-bold" id="b2">Generate CRUD</div>
				<div id="b2">
					Run the following command to generate the CRUD
					<pre class="border"><code class="language-html line-numbers">cake bake all tableName</code></pre>
				</div>
			</div>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Authentication &amp; Authorization</div>
				<div class="tricolor_line mb-3"></div>
				<div class="fw-bold" id="c1">Default Authentication Information</div>
				<div id="c1">
					Default authentication information / user account:
					Email: <kbd>recrud@codethepixel.com</kbd> Password: <kbd>123456</kbd>
				</div>
				<br />
				<div class="fw-bold" id="c2">Allow Unauthorized Page</div>
				<div id="c2">
					By default, the authentication plugin will block all pages. To allow unauthenticated page, insert the following code in the controller:
					<pre class="border"><code class="language-php line-numbers">
public function beforeFilter(\Cake\Event\EventInterface $event)
{
parent::beforeFilter($event);
$this->Authentication->addUnauthenticatedActions(['login','add']);
}
				</code></pre>
				</div>

				<div class="fw-bold" id="c3">Print Auth Info</div>
				<div id="c3">
					To print the current authenticated information eg, fullname, use the following code:
					<pre class="border"><code class="language-php line-numbers">echo $this->Identity->get('username');</code></pre>
				</div>

				<div class="fw-bold" id="c4">Conditional Checking</div>
				<div id="c4">
					Simple conditional checking:
					<pre class="border"><code class="language-php line-numbers">
if ($this->Identity->isLoggedIn()) {
	echo 'User Logged in';
}
</code></pre>
				</div>

				<div class="fw-bold" id="c5">Capture User ID</div>
				<div id="c5">
					To capture currently authenticated user ID in the controller, simply use the following code before save in the controller:
					<pre class="border"><code class="language-php line-numbers">$article->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id');</code></pre>
				</div>



			</div>
		</div>


		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Search</div>
				<div class="tricolor_line mb-3"></div>
				<div class="fw-bold" id="d1">Search Manager</div>
				<div id="d1">
					File Location: ...\src\Model\Table\YoursTable.php<br />
					If you need need to search more fields, add more attributes in the fields array.
					<pre class="border"><code class="language-php line-numbers">
public function initialize(array $config): void
{
	parent::initialize($config);

	//other codes
	
	$this->addBehavior('Search.Search');

	$this->searchManager()
		->value('role')
		->add('search', 'Search.Like', [ 
			'before' => true,
			'after' => true,
			'fieldMode' => 'OR',
			'comparison' => 'LIKE',
			'wildcardAny' => '*',
			'wildcardOne' => '?',
			'fields' => ['name','email','role'],
		]);
}
</code></pre>
				</div>
			</div>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Form and Others</div>
				<div class="tricolor_line mb-3"></div>
				<div class="fw-bold" id="e1">Button Style</div>
				<div id="e1">
					Button with outline primary style
					<pre class="border"><code class="language-php line-numbers">
$this->Html->link(__('<i class="fa-solid fa-plus"></i> Register'), ['action' => 'add'], ['class' => 'btn btn-sm btn-outline-primary', 'escapeTitle' => false])
</code></pre>
				</div>

				<div class="fw-bold" id="e2">Card</div>
				<div id="e2">
					Example of default card used in this project
					<pre class="border"><code class="language-html line-numbers">
&lt;div class="card bg-body-tertiary border-0 shadow mb-4"&gt
	&lt;div class="card-body"&gt
		&lt;div class="card-title mb-0"&gtSearch&lt;/div&gt
			&lt;div class="tricolor_line mb-3"&gt&lt;/div&gt
			
	&lt;/div&gt
&lt;/div&gt
</code></pre>
				</div>

				<div class="fw-bold" id="e3">Link</div>
				<div id="e3">
					External Link:
					<pre class="border"><code class="language-php line-numbers">
echo $this->Html->link('Enter','/pages/home', ['class' => 'button', 'target' => '_blank']);
</code></pre>
					Internal Link:
					<pre class="border"><code class="language-php line-numbers">
$this->Html->link(__('<i class="fa-solid fa-plus"></i> Register'), ['action' => 'add'], ['class' => '', 'escapeTitle' => false])
</code></pre>
				</div>

				<div class="fw-bold" id="e4">Image</div>
				<div id="e4">
					Put your image in .../webroot/img and load the following script:
					<pre class="border"><code class="language-php line-numbers">
echo $this->Html->image('logo.png', ['alt' => 'ReCRUD']);</code></pre>
				</div>

				<div class="fw-bold" id="e5">Date Time Format</div>
				<div id="e5">
					Sample code for rendering the date and time into readable format.
					<pre class="border"><code class="language-php line-numbers">
echo date('M d, Y (h:i A)', strtotime($user->created));</code></pre>
				</div>
			</div>
		</div>


		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">PDF Related</div>
				<div class="tricolor_line mb-3"></div>
				<div id="f1">
					PDF controller used to generate the PDF:
					<pre class="border"><code class="language-php line-numbers">
public function pdf($id = null)
{
    $this->viewBuilder()->enableAutoLayout(false); 
    $report = $this->Reports->get($id);
    $this->viewBuilder()->setClassName('CakePdf.Pdf');
    $this->viewBuilder()->setOption(
        'pdfConfig',
        [
            'orientation' => 'portrait',
            'download' => true, // This can be omitted if "filename" is specified.
            'filename' => 'Report_' . $id . '.pdf' //// This can be omitted if you want file name based on URL.
        ]
    );
    $this->set('report', $report);
}
	</code></pre>
				</div>

				<div class="fw-bold" id="f1">PDF</div>
				<div id="f2">
					<pre class="border"><code class="language-html line-numbers">xxx</code></pre>
				</div>


				<div class="fw-bold" id="f1">PDF</div>
				<div id="f3">
					File Location: ...\src\Model\Table\YoursTable.php<br />
					If you need need to search more fields, add more attributes in the fields array.
					<pre class="border"><code class="language-html line-numbers">
&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
&lt;title&gt;PDF&lt;/title&gt;
&lt;style&gt;
@page {
    margin: 0px 0px 0px 0px !important;
    padding: 0px 0px 0px 0px !important;
}
&lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
	Content
&lt;/body&gt;
&lt;/html&gt;
</code></pre>
				</div>

				<div class="fw-bold" id="f1">PDF</div>
				<div id="f4">
					<pre class="border"><code class="language-html line-numbers">xxx</code></pre>
				</div>

				<div class="fw-bold" id="f1">PDF</div>
				<div id="f5">
					<pre class="border"><code class="language-html line-numbers">xxx</code></pre>
				</div>

				<div class="fw-bold" id="f1">PDF</div>
				<div id="f6">
					<pre class="border"><code class="language-html line-numbers">xxx</code></pre>
				</div>

				<div class="fw-bold" id="f1">PDF</div>
				<div id="f7">
					<pre class="border"><code class="language-html line-numbers">xxx</code></pre>
				</div>

				<div class="fw-bold" id="f1">PDF</div>
				<div id="f8">
					<pre class="border"><code class="language-html line-numbers">xxx</code></pre>
				</div>
			</div>
		</div>


		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Meta Tag</div>
				<div class="tricolor_line mb-3"></div>
				<div class="fw-bold" id="g1">Meta Tag</div>
				<div id="g1">
					If have custom meta tags, include the following code to the controller. The default meta tag will be overwrite.
					<pre class="border"><code class="language-php line-numbers">
        $this->set('title', 'Sign-in');
        $this->set('metaTitle', 'Re-CRUD Login');
        $this->set('metaKeywords', 'recrud, re-crud, login, auth');
        $this->set('metaSubject', 'Learning Coding');
        $this->set('metaCopyright', 'Re-CRUD');
        $this->set('metaDescription', 'This is a login page only');
	</code></pre>
				</div>
			</div>
		</div>


		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Content</div>
				<div class="tricolor_line mb-3"></div>
				<pre class="border"><code class="language-html line-numbers">code</code></pre>
			</div>
		</div>



	</div>
</div>