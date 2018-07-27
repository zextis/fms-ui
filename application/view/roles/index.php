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
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">Roles</h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-eye-outline icon-small"></i>
                            View Roles</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ion-ios-plus-outline icon-small"></i>
                            New Role</a>
                    </li>
                </ul>
                <div class="tab_content">
                    <div id="addreq" class="tabs_item">
                        <p class="hint">
                            <strong>TIP:</strong> Click on column titles to sort. You can also hold
                            <kbd>Shift</kbd> or
                            <kbd>Ctrl</kbd> and click more titles to add more sorts.</p>
                        <div class="tablewrapper">
                            <table class="ptable" id="userTable" border="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Permissions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($this->roles as $role) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                        <?php
                                            $role_permissions = ($role->permissions) ? explode(',', $role->permissions) : []; ?>
                                        <ul>
                                            <?php foreach($role_permissions as $permission): ?>
                                            <li><?= $permission ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        </td>
                                     
                                        <td class="edit">
                                            <a href="<?= URL . 'roles/edit/' . $role->id ?>" class="opt">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div id="addreq" class="tabs_item">
                        <form action="<?= URL ?>roles/store" method="post" class="form clearfix newform">

                            <span class="in_form1">
                                <label for="name">Role</label>
                                <input type="text" name="name" id="name" placeholder="Action to perform" required>
                            </span>

                            <span class="in_form1">
                                <p class="hint">
                                <strong>TIP:</strong> Hold <kbd>Ctrl</kbd> to select multiple permissions.</p>
                                <label for="facility_id">Permissions</label>
                                <select type="text" name="permissions[]" id="permissions" multiple required>
                                    <option value="">Select permissions</option>
                                    <?php foreach ($this->permissions as $permission) : ?> 
                                    <option value="<?= $permission->id ?>"><?php echo htmlspecialchars($permission->name, ENT_QUOTES, 'UTF-8'); ?></option> 
                                    <?php endforeach; ?>
                                </select>
                            </span>

                            <span class="form__btn--group">
                                <input type="reset" value="reset" class="btn btn-small btn-reset">
                                <input type="submit" value="Send Role" class="btn" name="submit_add_role">
                            </span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>