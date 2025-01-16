<?php
//$cakeDescription = $system_name;
use Cake\Core\Configure;
use Cake\Routing\Router;

$c_name = $this->request->getParam('controller');
$a_name = $this->request->getParam('action');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->Html->charset() ?>

    <!-- Basic Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="title" content="<?= $this->fetch($meta_title) ?: $metaTitle ?>">
    <meta name="keyword" content="<?= $this->fetch($meta_keyword) ?: $metaKeywords ?>">
    <meta name="subject" content="<?= $this->fetch($meta_subject) ?: $metaSubject ?>">
    <meta name="copyright" content="<?= $this->fetch($meta_copyright) ?: $metaCopyright ?>">
    <meta name="description" content="<?= $this->fetch($meta_desc) ?: $metaDescription ?>">
    <!-- SEO Meta Tags -->
    <?php
    echo $this->Html->meta('title', $meta_title) . "\n";
    echo $this->Html->meta('keyword', $meta_keyword) . "\n";
    echo $this->Html->meta('subject', $meta_subject) . "\n";
    echo $this->Html->meta('copyright', $meta_copyright) . "\n";
    echo $this->Html->meta('description', $meta_desc) . "\n";
    ?>

    <!-- Subject and Copyright Meta Tags -->
    <meta name="subject" content="<?php echo $meta_subject; ?>">
    <meta name="copyright" content="<?php echo $meta_copyright; ?>">

    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="<?php echo $meta_title; ?>">
    <meta property="og:description" content="<?php echo $meta_desc; ?>">
    <meta property="og:image" content="URL to your image">
    <meta property="og:url" content="https://<?php echo $domain_name; ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $meta_title; ?>">
    <meta name="twitter:description" content="<?php echo $meta_desc; ?>">
    <meta name="twitter:image" content="URL to your image">
    <meta name="twitter:site" content="@yourtwitterhandle">



    <title><?= $system_abbr ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Monomaniac+One&family=Protest+Guerrilla&family=Roboto+Condensed&family=Roboto:wght@100;300;400;500&family=Victor+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php
    //Meta info
    //echo $this->Html->meta('title', $meta_title, ['block' => true]);
    //echo $this->Html->meta('keyword', $meta_keyword, ['block' => true]);
    //echo $this->Html->meta('subject', $meta_subject, ['block' => true]);
    //echo $this->Html->meta('copyright', $meta_copyright, ['block' => true]);
    //echo $this->Html->meta('description', $meta_desc, ['block' => true]);
    //echo $this->Html->css('core');
    //echo $this->Html->css('theme-default');
    echo $this->Html->css('style');
    //Vendors
    //echo $this->Html->css('perfect-scrollbar.css');
    //Helpers
    echo $this->Html->script('color-modes.js');
    echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js');
    //Bottom JS
    echo $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', ['block' => 'scriptBottom']);
    //echo $this->Html->script('custom.js', ['block' => 'scriptBottom']);
    //echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>

<body>

    <?php if ($ribbon_status == true) : ?>
        <?php echo $this->element('ribbon'); ?>
    <?php endif; ?>

    <?php if ($notification_status == true) : ?>
        <?php echo $this->element('notification_bar'); ?>
    <?php endif; ?>

    <!-- Wrapper -->
    <div class="wrapper text-body-secondary">
        <!-- Sidebar -->
        <?php echo $this->element('menu/sidebar'); ?>
        <!-- Page Content -->
        <div class="content-fluid">
            <!-- Navbar -->
            <?php echo $this->element('menu/topbar'); ?>
            <!-- OffCanvas -->
            <?php echo $this->element('offcanvas'); ?>
            <!-- Content -->
            <div class="content">

                <!-- Container -->
                <div class="container">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </div>


            <!-- Footer -->
            <div class="container-fluid bd-footer px-5 bg-body-tertiary">
                <footer class="py-5">
                    <div class="row">
                        <div class="col-6 col-md-2 mb-3">
                            <h5>Internal Links</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2">
                                    <?= $this->Html->link(__('Dashboard'), ['controller' => 'Dashboards', 'action' => 'index', 'prefix' => false], ['class' => 'nav-link p-0 text-muted', 'escape' => false]) ?>
                                </li>
                                <li class="nav-item mb-2"><?= $this->Html->link(__('Frequently Asked Questions'), ['controller' => 'Faqs', 'action' => 'index', 'prefix' => false], ['class' => 'nav-link p-0 text-muted', 'escape' => false]) ?></li>
                                <li class="nav-item mb-2"><?= $this->Html->link(__('Contact'), ['controller' => 'Contacts', 'action' => 'add', 'prefix' => false], ['class' => 'nav-link p-0 text-muted', 'escape' => false]) ?></li>
                                <li class="nav-item mb-2"><?= $this->Html->link(__('Documentation Manual'), ['controller' => 'Pages', 'action' => 'manual', 'prefix' => false], ['class' => 'nav-link p-0 text-muted', 'escape' => false]) ?></li>
                            </ul>
                        </div>

                        <div class="col-6 col-md-2 mb-3">
                            <h5>Important Links</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2"><a href="https://github.com/Asyraf-wa" class="nav-link p-0 text-muted" target="_blank">ReCRUD Github</a></li>
                                <li class="nav-item mb-2"><a href="https:/codethepixel.com" class="nav-link p-0 text-muted" target="_blank">Code The Pixel</a></li>
                                <li class="nav-item mb-2"><a href="hhttps://getbootstrap.com/" class="nav-link p-0 text-muted" target="_blank">Bootstrap</a></li>
                                <li class="nav-item mb-2"><a href="https://cakephp.org/" class="nav-link p-0 text-muted" target="_blank">CakePHP</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-md-2 mb-3">
                            <a class="hover-fx"><i class="fa-brands fa-facebook fs-4"></i></a>
                            <a class="hover-fx"><i class="fa-brands fa-instagram fs-4"></i></a>
                            <a class="hover-fx"><i class="fa-brands fa-x-twitter fs-4"></i></a>
                            <a class="hover-fx"><i class="fa-brands fa-linkedin fs-4"></i></a>
                            <a class="hover-fx"><i class="fa-brands fa-threads fs-4"></i></a>
                            <a class="hover-fx"><i class="fa-brands fa-github fs-4"></i></a>
                            <a class="hover-fx"><i class="fa-brands fa-gitlab fs-4"></i></a>
                            <a class="hover-fx"><i class="fa-brands fa-codepen fs-4"></i></a>
                        </div>

                        <div class="col-md-5 offset-md-1 mb-3">
                            <form>
                                <h5>Subscribe to our newsletter</h5>
                                <p>Monthly digest of what's new and exciting from us.</p>
                                <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                                    <label for="newsletter1" class="visually-hidden">Email address</label>
                                    <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                                    <button class="btn btn-primary" type="button">Subscribe</button>
                                </div>
                            </form>
                            <div class="text-end pt-3">
                                <!-- Github Tag -->
                                <a class="github-button" href="https://github.com/Asyraf-wa/recrud" data-icon="octicon-star" data-show-count="true" aria-label="Star buttons/github-buttons on GitHub">Star</a>
                                <a class="github-button" href="https://github.com/Asyraf-wa/recrud" data-icon="octicon-repo-forked" data-show-count="true" aria-label="Fork buttons/github-buttons on GitHub">Fork</a>
                                <a class="github-button" href="https://github.com/Asyraf-wa/recrud" aria-label="Follow @recrud on GitHub">Follow @recrud</a>
                                <a class="github-button" href="https://github.com/Asyraf-wa/recrud/archive/refs/heads/main.zip" data-icon="octicon-download" aria-label="Download buttons/github-buttons on GitHub">Download</a>
                                <script async defer src="https://buttons.github.io/buttons.js"></script>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between pt-4  border-top">
                        <p>© <?php echo date('Y'); ?> <?php echo $system_name; ?>. <i class="fa-solid fa-code"></i> with ❤️ by
                            <a href="https://codethepixel.com" target="_blank" class="footer-link fw-bolder">Code The Pixel</a>
                        </p>
                    </div>
                </footer>
            </div>
            <!-- / Footer -->
        </div>
    </div>



    <!-- / Layout wrapper -->
    <?= $this->fetch('scriptBottom') ?>

    <!-- jQuery CDN - Slim version (=without AJAX)
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script> -->
    <!-- Bootstrap JS 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>-->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>