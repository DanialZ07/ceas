<?php

use Cake\Routing\Router;

echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
echo $this->Html->css('jquery.datetimepicker.min.css');
echo $this->Html->script('jquery.datetimepicker.full.js');
echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
$c_name = $this->request->getParam('controller');
echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
?>
<!--Header-->
<div class="row text-body-secondary">
    <div class="col-12">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
</div>
<div class="line mb-4"></div>

<div class="row">
    <div class="col-md-6">
        <div class="card bg-body-tertiary border-0 shadow mb-4">
            <div class="card-body">
                <div class="card-title mb-0">General</div>
                <div class="tricolor_line mb-3"></div>
                <?php foreach ($general as $faq) : ?>
                    <a href="#<?= ($faq->category) . ($faq->id) ?>" class="" data-bs-toggle="collapse" aria-controls="<?= ($faq->category) . ($faq->id) ?>"><i class="far fa-plus-square"></i> <?= h($faq->question) ?><br></a>
                    <div class="collapse" id="<?= ($faq->category) . ($faq->id) ?>">
                        <?= ($faq->answer) ?><br /><br />
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="special_card mb-3">
            <div class="card bg-body-tertiary border-0 shadow mb-4">
                <div class="card-body">
                    <div class="card-title mb-0">Account</div>
                    <div class="tricolor_line mb-3"></div>
                    <?php foreach ($account as $faq) : ?>
                        <a href="#<?= ($faq->category) . ($faq->id) ?>" class="" data-bs-toggle="collapse" aria-controls="<?= ($faq->category) . ($faq->id) ?>"><i class="far fa-plus-square"></i> <?= h($faq->question) ?><br></a>
                        <div class="collapse" id="<?= ($faq->category) . ($faq->id) ?>">
                            <?= ($faq->answer) ?><br /><br />
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-body-tertiary border-0 shadow mb-4">
            <div class="card-body">
                <div class="card-title mb-0">Others</div>
                <div class="tricolor_line mb-3"></div>
                <?php foreach ($other as $faq) : ?>
                    <a href="#<?= ($faq->category) . ($faq->id) ?>" class="" data-bs-toggle="collapse" aria-controls="<?= ($faq->category) . ($faq->id) ?>"><i class="far fa-plus-square"></i> <?= h($faq->question) ?><br></a>
                    <div class="collapse" id="<?= ($faq->category) . ($faq->id) ?>">
                        <?= ($faq->answer) ?><br /><br />
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>