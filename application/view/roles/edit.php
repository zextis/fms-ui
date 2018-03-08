<body class="grey-bg">
<div class="row">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div class="col span-2-of-12 side-nav clearfix matbox">

            <!-- echo out the sidebar -->
            <?php $this->renderSidebar(); ?>

        </div>
        <div class="col span-10-of-12 main-content">
            <header class="header">
                <div class="header__text-box">
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">Edit User</h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-plus-outline icon-small"></i>
                            Edit Request</a>
                    </li>
                </ul>
                <div class="tab_content">
                    <div id="addreq" class="tabs_item">
                        <form action="<?php echo URL . 'roles/update/' . htmlspecialchars($this->role->id, ENT_QUOTES, 'UTF-8'); ?>" method="post" class="form clearfix newform">

                            <span class="in_form1">
                                <label for="name">Permission</label>
                                <input type="text" name="name" id="name" placeholder="Action to perform" value="<?php echo htmlspecialchars($this->role->name, ENT_QUOTES, 'UTF-8'); ?>"  required>
                            </span>

                            <span class="in_form1">
                                <p class="hint">
                                <strong>TIP:</strong> Hold <kbd>Ctrl</kbd> to select multiple permissions.</p>
                                <label for="facility_id">Permissions</label>

                                <input type="hidden" name="old_permissions" value="<?= $this->role->permissions ?>">
                                <?php 
                                // Separate the roles by comman into an array to set the roles
                                // selected.
                                $role_permissions = ($this->role->permissions) ? explode(',', $this->role->permissions) : []; ?>

                                <select type="text" name="permissions[]" id="permissions" multiple required>
                                    <option value="">Select permissions</option>
                                    <?php foreach ($this->permissions as $permission) : ?> 
                                    <option <?= (in_array($permission->id, $role_permissions)) ? 'selected' : '' ?> value="<?= $permission->id ?>"><?php echo htmlspecialchars($permission->name, ENT_QUOTES, 'UTF-8'); ?></option> 
                                    <?php endforeach; ?>
                                </select>
                            </span>

                            <span class="form__btn--group">
                                <input type="submit" value="Edit Permission" class="btn" name="submit_update_role">
                            </span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
