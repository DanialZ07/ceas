<!--Header-->
<div class="row text-body-secondary">
    <div class="col-10">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
    <div class="col-2 text-end">
        <div class="btn-group bg-transparent">
            <button type="button" class="btn border-0" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-bars text-primary"></i>
            </button>
            <ul class="dropdown-menu">
                <li><?= $this->Html->link(__('Edit Faq'), ['action' => 'edit', $faq->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
                <li><?= $this->Form->postLink(__('Delete Faq'), ['action' => 'delete', $faq->id], ['confirm' => __('Are you sure you want to delete # {0}?', $faq->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><?= $this->Html->link(__('List Faqs'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
                <li><?= $this->Html->link(__('New Faq'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card bg-body-tertiary border-0 shadow mb-4">
    <div class="card-body">
        <div class="card-title mb-0">Frequently Asked Question</div>
        <div class="tricolor_line mb-3"></div>
        <div class="table-responsive">
            <table table class="table table-hovered table-sm">
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= h($faq->category) ?></td>
                </tr>
                <tr>
                    <th><?= __('Question') ?></th>
                    <td><?= h($faq->question) ?></td>
                </tr>
                <tr>
                    <th><?= __('Answer') ?></th>
                    <td><?= h($faq->answer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td>
                        <?php if ($faq->status == 1) {
                            echo '<span class="badge bg-success">Active</span>';
                        } elseif ($user->status == 0) {
                            echo '<span class="badge bg-danger">Disabled</span>';
                        } else
                            echo '<span class="badge bg-secondary">Archived</span>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= date('d M Y - h:i:sa', strtotime($faq->created)); ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= date('d M Y - h:i:sa', strtotime($faq->modified)); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>