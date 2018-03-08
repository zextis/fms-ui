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
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">Permissions</h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-eye-outline icon-small"></i>
                            View Permissions</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ion-ios-plus-outline icon-small"></i>
                            New Permission</a>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($this->permissions as $permission) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($permission->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                     
                                        <td class="edit">
                                            <a href="<?= URL . 'permissions/edit/' . $permission->id ?>" class="opt">
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
                        <form action="<?= URL ?>permissions/store" method="post" class="form clearfix newform">

                            <span class="in_form1">
                                <label for="name">Permission</label>
                                <input type="text" name="name" id="name" placeholder="Action to perform" required>
                            </span>

                            <span class="form__btn--group">
                                <input type="reset" value="reset" class="btn btn-small btn-reset">
                                <input type="submit" value="Send Permission" class="btn" name="submit_add_permission">
                            </span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>