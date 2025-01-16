<?php
echo $this->Html->script('inputmask/min/jquery.inputmask.bundle.min.js', ['block' => 'scriptBottom']);
?>
<!--Header-->
<div class="row text-body-secondary">
    <div class="col-10">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
    <div class="col-2 text-end">
        <?= $this->Html->link(__('<i class="fas fa-arrow-left"></i> Back'), ['controller' => 'contact'], ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false]) ?>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card bg-body-tertiary border-0 shadow mb-4">
    <div class="card-body">
        <?php echo $this->Form->create(null, ['valueSources' => 'query']); ?>

        <?php echo $this->Form->control('ticket', ['class' => 'form-control', 'required' => false, 'label' => 'Ticket No.', 'id' => 'ticket', 'data-inputmask-clearmaskonlostfocus' => false]); ?>

        <div class="text-end">
            <?php if (!empty($_isSearch)) {
                echo ' ';
                echo $this->Html->link(__('Reset'), ['action' => 'check', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-primary']);
            }
            ?>
            <?php echo $this->Form->button(__('Search'), ['class' => 'btn btn-outline-primary']); ?>
            <?php echo $this->Form->end(); ?>
        </div>




        <?php if ($count_ticket == '1') : ?>
            <hr>
            <?php foreach ($contacts as $contact) : ?>
                <div class="row">
                    <div class="col-md-5">
                        <div class="table-responsive">
                            <table class="table table-hover text-secondary px-1 table-sm">
                                <tr>
                                    <th><?= __('Ticket') ?></th>
                                    <td><?= h($contact->ticket) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Subject') ?></th>
                                    <td><?= h($contact->subject) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Name') ?></th>
                                    <td><?= h($contact->name) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Email') ?></th>
                                    <td><?= h($contact->email) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Reply Status') ?></th>
                                    <td>
                                        <?php if ($contact->is_replied == true) {
                                            echo '<i class="fa-solid fa-check text-success"></i>';
                                        } else
                                            echo '<i class="fa-solid fa-xmark text-danger"></i>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?= __('Respond Date Time') ?></th>
                                    <td>
                                        <?php if ($contact->respond_date_time == NULL) {
                                            echo '-';
                                        } else
                                            echo date('d M Y  (g:i a)', strtotime($contact->respond_date_time));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?= __('Created') ?></th>
                                    <td><?= date('d M Y  (g:i a)', strtotime($contact->created)); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-7 text-secondary">
                        <div class="text">
                            <strong><?= __('Notes from ') ?><?= h($contact->name) ?></strong>
                            <blockquote>
                                <?= $this->Text->autoParagraph(h($contact->notes)); ?>
                            </blockquote>
                        </div>
                        <hr>
                        <div class="text">
                            <strong><?= __('Reply from admin') ?></strong>
                            <blockquote>
                                <?= $this->Text->autoParagraph($contact->note_admin); ?>
                            </blockquote>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($count_ticket == null) : ?>
            Sorry, no ticket found
        <?php endif; ?>

        <!-- 9 : numeric, a : alphabetical, * : alphanumeric -->
        <script>
            $(document).ready(function() {
                $("#ticket").inputmask("***-****");
            });
        </script>




    </div>
</div>