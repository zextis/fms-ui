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
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">User Manager</h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-eye-outline icon-small"></i>
                            View Users</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ion-ios-plus-outline icon-small"></i>
                            New User</a>
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
                                        <th>E-mail</th>
                                        <th>Facility</th>
                                        <th>Roles</th>
                                        <th>Active</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($this->users as $user) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->facility, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                        <?php echo htmlspecialchars($user->roles, ENT_QUOTES, 'UTF-8'); ?>
                                        <?php
                                            $roles = ($user->roles) ? explode(',', $user->roles) : []; ?>
                                        <!-- <ul>
                                            <?php //foreach($roles as $role): ?>
                                            <li><?php // $role ?></li>
                                            <?php //endforeach; ?>
                                        </ul> -->
                                        </td>
                                        <td><?php echo htmlspecialchars($user->is_active ? 'Yes' : 'No', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="edit">
                                            <a href="<?= URL . 'users/edit/' . $user->id ?>" class="opt">
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
                        <form action="<?= URL ?>users/store" method="post" class="form clearfix newform">
                            <span class="in_form1">
                                <label for="facility_id">Facility</label>
                                <select type="text" name="facility_id" id="facility_id" required>
                                    <option value="">Select facility</option>
                                    <?php foreach ($this->facilities as $facility) : ?> 
                                    <option value="<?= $facility->id ?>"><?php echo htmlspecialchars($facility->name . ' ' . $facility->location, ENT_QUOTES, 'UTF-8'); ?></option> 
                                    <?php endforeach; ?>
                                </select>
                            </span>

                            <span class="in_form1">
                                <label for="first_name">First name</label>
                                <input type="text" name="first_name" id="first_name" placeholder="First name" required>
                            </span>

                            <span class="in_form1">
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" id="last_name" placeholder="Last name" required>
                            </span>

                            <span class="in_form1">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" placeholder="user@mail.com" required>
                            </span>

                            <span class="in_form1">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="" required>
                            </span>

                            <span class="in_form1">
                                <p class="hint">
                                <strong>TIP:</strong> Hold <kbd>Ctrl</kbd> to select multiple roles.</p>
                                <label for="roles">Roles</label>
                                <select type="text" name="roles[]" id="roles" multiple required>
                                    <?php foreach ($this->roles as $role) : ?> 
                                    <option value="<?= $role->id ?>"><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></option> 
                                    <?php endforeach; ?>
                                </select>
                            </span>

                            <span class="in_form1">
                                <label for="is_active">Active</label>
                                <input type="checkbox" name="is_active" id="is_active" placeholder="">
                            </span>

                            <span class="form__btn--group">
                                <input type="reset" value="reset" class="btn btn-small btn-reset">
                                <input type="submit" value="Send User" class="btn" name="submit_add_user">
                            </span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>