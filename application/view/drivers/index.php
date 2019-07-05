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
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">
                        Driver Manager
                    </h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-eye-outline icon-small"></i>
                            View Drivers</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ion-ios-plus-outline icon-small"></i>
                            New Driver</a>
                    </li>
                </ul>
                <div class="tab_content">
                    <div id="view" class="tabs_item">
                        <p class="hint">
                            <strong>Hint:</strong> Click on column titles to sort. You can also hold
                            <kbd>Shift</kbd> or
                            <kbd>Ctrl</kbd> and click more titles to add more sorts.</p>
                        <div class="tablewrapper">
                            <span class="in_form">
                                <label for="search-status">Filter: </label>
                                <select id="search-status" name="status">
                                    <option value="" disabled selected>Status</option>
                                    <option value="">all</option>
                                    <option>active</option>
                                    <option>inactive</option>
                                </select>
                            </span>

                            <table class="ptable" id="driverTable" border="0">
                                <thead>
                                    <tr>
                                        <th>Employee No.</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Facility</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($this->drivers as $driver) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($driver->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($driver->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($driver->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($driver->facility, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($driver->is_active == 1 ? "active" : "inactive" , ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="edit">
                                            <?php $url = URL . 'drivers/edit/' . $driver->id; ?>
                                            <a href="<?= $url ?>" class="opt">

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
                        <form action="<?= URL ?>drivers/store" method="post" class="form clearfix newform" id="driverform">
                            <span class="in_form">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                            </span>

                            <span class="in_form">
                                <label for="last_name">Last Name                          </label>
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                            </span>

                            <span class="in_form">
                                <label for="facility">Facility: </label>
                                <select id="facility" name="facility">
                                    <option value="" selected>Choose Facility</option>
                                    <?php foreach ($this->facilities as $facility) : ?>
                                    <option value="<?= $facility->id?>"><?php echo htmlspecialchars($facility->name, ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php endforeach; ?>
                                </select>
                            </span>

                            <span class="in_form">
                                <label for="">Driver Status: </label>
                                <div class="radio-group">
                                    <label for="status-active">Active</label>
                                    <input type="radio" id="status-active" name="status" value="1" checked>
                                    <label for="status-inactive">Inactive</label>
                                    <input type="radio" name="status" id="status-inactive" value="0">
                                </div>
                            </span>


                            <span class="form__btn--group">
                                <input type="reset" value="reset" class="btn btn-small btn-reset">
                                <input type="submit" value="Add Driver" class="btn" name="submit_add_driver">
                            </span>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
