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
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">Edit Driver #<?php echo htmlspecialchars($this->drivers->id, ENT_QUOTES, 'UTF-8'); ?> 
                    </h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-plus-outline icon-small"></i>
                            Edit Driver</a>
                    </li>
                </ul>
                <div class="tab_content">
                    <div id="addreq" class="tabs_item">
                        <form action="<?php echo URL . 'drivers/update/' . htmlspecialchars($this->drivers->id, ENT_QUOTES, 'UTF-8'); ?>" method="post" class="form clearfix newform">
                        <!-- TODO:ADD NINJA CODE TO MAKE THIS DO MAGIC -->
                        <input type="hidden" name="id" value="1">
                            <span class="in_form">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($this->drivers->first_name, ENT_QUOTES, 'UTF-8'); ?>" required>
                            </span>

                            <span class="in_form">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($this->drivers->last_name, ENT_QUOTES, 'UTF-8'); ?>" required>
                            </span>

                             <span class="in_form">
                                <label for="facility">Facility: </label>
                                <select id="facility" name="facility">
                                    <option value="" selected>Choose Facility</option>
                                    <?php foreach ($this->facilities as $facility) : ?>
                                    <option <?php echo $this->drivers->facility_id==$facility->id ? 'selected' : ""; ?> value="<?= $facility->id?>"><?php echo htmlspecialchars($facility->name, ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php endforeach; ?>
                                </select>
                            </span>

                          <span class="in_form">
                                <label for="">Driver Status: </label>
                                <div class="radio-group">
                                    <label for="status-active">Active</label>
                                    <input <?php echo $this->drivers->is_active==1 ? 'checked' : ""; ?> type="radio" id="status-active" name="status" value="1" checked>
                                    <label for="status-inactive">Inactive</label>
                                    <input <?php echo $this->drivers->is_active==0 ? 'checked' : ""; ?> type="radio" name="status" id="status-inactive" value="0">
                                </div>
                            </span>


                            <span class="form__btn--group">
                                <input type="submit" value="Update Driver" class="btn btn-submit" name="submit_update_driver">
                            </span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
