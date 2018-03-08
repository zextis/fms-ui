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
                        <form action="<?php echo URL . 'permissions/update/' . htmlspecialchars($this->permission->id, ENT_QUOTES, 'UTF-8'); ?>" method="post" class="form clearfix newform">

                            <span class="in_form1">
                                <label for="name">Permission</label>
                                <input type="text" name="name" id="name" placeholder="Action to perform" value="<?php echo htmlspecialchars($this->permission->name, ENT_QUOTES, 'UTF-8'); ?>"  required>
                            </span>

                            <span class="form__btn--group">
                                <input type="submit" value="Edit Permission" class="btn" name="submit_update_permission">
                            </span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
