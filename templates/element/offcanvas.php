<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
            <?php
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $h = date('G');

            if ($h >= 5 && $h <= 11) {
                echo "Good morning";
            } else if ($h >= 12 && $h <= 15) {
                echo "Good afternoon";
            } else {
                echo "Good evening";
            }
            ?>, <?php echo $this->Identity->get('fullname');
                ?>
        </h6>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <div class="card bg-gold">
            <div class="p-3 text-center">
                <?php if ($this->Identity->get('avatar') != NULL) {
                    echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'), ['class' => 'd-block rounded-circle shadow', 'width' => '130px', 'height' => '130px']);
                } else
                    echo $this->Html->image('blank_profile.png', ['class' => 'd-block rounded-circle shadow', 'width' => '130px', 'height' => '130px']);
                ?>
            </div>
        </div>

        <div class="px-3">

            <table class="table table-borderless table-sm">
                <tr>
                    <th width="20%">Name</th>
                    <td><?php echo $this->Identity->get('fullname');
                        ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $this->Identity->get('email');
                        ?></td>
                </tr>
                <tr>
                    <th>Last Login</th>
                    <td><?php echo date('M d, Y (h:i A)', strtotime($this->Identity->get('last_login')));
                        ?></td>
                </tr>
                <tr>
                    <th>Group</th>
                    <td>
                        <?php if ($this->Identity->get('user_group_id') == 1) {
                            echo 'Administrator';
                        } elseif ($this->Identity->get('user_group_id') == 2) {
                            echo 'Moderator';
                        } elseif ($this->Identity->get('user_group_id') == 3) {
                            echo 'User';
                        } else
                            echo 'Error';
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php if ($this->Identity->get('status') == 1) {
                            echo '<span class="badge bg-success">Active</span>';
                        } elseif ($this->Identity->get('status') == 0) {
                            echo '<span class="badge bg-danger">Disabled</span>';
                        } else
                            echo '<span class="badge bg-secondary">Archived</span>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Verified</th>
                    <td>
                        <?php if ($this->Identity->get('is_email_verified') == 1) {
                            echo '<span class="badge bg-success">Verified</span>';
                        } else
                            echo '<span class="badge bg-danger">Not verified</span>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Created on</th>
                    <td><?php echo date('M d, Y (h:i A)', strtotime($this->Identity->get('created')));
                        ?></td>
                </tr>
            </table>

            <?php if ($this->Identity->isLoggedIn()) {
            ?>
                <div class="text-end">
                    <?php echo $this->Html->link('<i class="fa-solid fa-arrow-right-from-bracket"></i> Logout', ['controller' => 'Users', 'action' => 'logout', 'prefix' => false], ['class' => 'btn btn-sm btn-outline-primary transparent', 'escape' => false, 'alt' => 'Sign-out']); ?>

                </div>
            <?php }
            ?>



        </div>



    </div>
</div>