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
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">Edit Permission</h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-plus-outline icon-small"></i>
                            Edit Permission</a>
                    </li>
                </ul>
                <div class="tab_content">
                    <div id="addreq" class="tabs_item">
                        <form action="<?php echo URL . 'users/update/' . htmlspecialchars($this->user->id, ENT_QUOTES, 'UTF-8'); ?>" method="post" class="form clearfix newform">

                            <span class="in_form1">
                                <label for="facility_id">Facility</label>
                                <select type="text" name="facility_id" id="facility_id" required>
                                    <option value="">Select facility</option>
                                    <?php foreach ($this->facilities as $facility) : ?> 
                                    <option <?= ($this->user->facility_id == $facility->id) ? 'selected' : '' ?> value="<?= $facility->id ?>"><?php echo htmlspecialchars($facility->name . ' ' . $facility->location, ENT_QUOTES, 'UTF-8'); ?></option> 
                                    <?php endforeach; ?>
                                </select>
                            </span>

                            <span class="in_form1">
                                <label for="first_name">First name</label>
                                <input type="text" name="first_name" id="first_name" placeholder="First name" value="<?php echo htmlspecialchars($this->user->first_name, ENT_QUOTES, 'UTF-8'); ?>" required>
                            </span>

                            <span class="in_form1">
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" id="last_name" placeholder="Last name" value="<?php echo htmlspecialchars($this->user->last_name, ENT_QUOTES, 'UTF-8'); ?>" required>
                            </span>

                            <span class="in_form1">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" placeholder="user@mail.com" value="<?php echo htmlspecialchars($this->user->email, ENT_QUOTES, 'UTF-8'); ?>" required>
                            </span>

                            <span class="in_form1">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password">
                            </span>

                            <span class="in_form1">
                                <p class="hint">
                                <strong>TIP:</strong> Hold <kbd>Ctrl</kbd> to select multiple roles.</p>
                                <label for="roles">Roles</label>
                                <input type="hidden" name="old_roles" value="<?= $this->user->roles ?>">
                                <?php 
                                // Separate the roles by comman into an array to set the roles
                                // selected.
                                $user_roles = ($this->user->roles) ? explode(',', $this->user->roles) : []; ?>
                                <select type="text" name="roles[]" id="roles" multiple required>
                                    <?php foreach ($this->roles as $role) : ?> 
                                    <option <?= (in_array($role->id, $user_roles)) ? 'selected' : '' ?> value="<?= $role->id ?>"><?php echo htmlspecialchars($role->name, ENT_QUOTES, 'UTF-8'); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </span>

                            <span class="in_form1">
                                <label for="is_active">Active</label>
                                <input type="checkbox" name="is_active" id="is_active" placeholder="" <?= ($this->user->is_active) ? 'checked' : '' ?>>
                            </span>

                            <span class="form__btn--group">
                                <input type="submit" value="Edit User" class="btn" name="submit_update_user">
                            </span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
