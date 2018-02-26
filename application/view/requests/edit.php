<body>
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
                    <h2 class="header__heading">
                        Request Manager
                    </h2>
                </div>
            </header>
            <div class="row tabs">
                <div class="col span-1-of-2 tab">
                    <button disabled class="tablink" onclick="openPage('view', this, 'white')" id="defaultOpen">
                        View Requests
                        <i class="ion-ios-eye-outline icon-small"></i>
                    </button>
                </div>
                <div class="col span-1-of-2 tab">
                    <!-- NOTE: Change the background color to show the tab as active.  -->
                    <button class="tablink" onclick="openPage('addreq', this, 'white')" style="background-color: white;">
                        Edit Request
                        <i class="ion-ios-plus-outline icon-small"></i>
                    </button>
                </div>
                <div id="view" class="tabcontent">
                    <!-- NOTE: List of request not shown when editing a request. -->
                </div>

                <!-- NOTE: Add display style block to show contents to update request. -->
                <div id="addreq" class="tabcontent" style="display: block;">
                    <form action="<?php echo URL . 'requests/update/' . htmlspecialchars($this->request->id, ENT_QUOTES, 'UTF-8');; ?>" method="post" class="form sign-form matbox clearfix">
                        <input type="hidden" name="facility_id" value="1">
                        <!-- <h2 class="form__title">New Request</h2> -->
                        <div class="row">
                            <div class="col span-1-of-2">
                                <label for="department">Department</label>
                                <input type="text" name="department" id="department" placeholder="Department" value="<?php echo htmlspecialchars($this->request->department, ENT_QUOTES, 'UTF-8'); ?>" required>

                                <label for="num_pers">Number of Persons
                                    <span>(maximum: 30)</span>
                                </label>
                                <input type="number" value="<?php echo htmlspecialchars($this->request->number_of_persons, ENT_QUOTES, 'UTF-8'); ?>" name="num_pers" id="num_pers" min="1" max="30" required>

                                <label for="purpose">Purpose</label>
                                <textarea name="purpose" id="purpose" cols="20" rows="2" placeholder="State the reason for your trip." required><?php echo htmlspecialchars($this->request->purpose_of_trip, ENT_QUOTES, 'UTF-8'); ?></textarea>

                                <label for="destination">Destination</label>
                                <input type="text" name="destination" id="destination" placeholder="Destination" value="<?php echo htmlspecialchars($this->request->destination, ENT_QUOTES, 'UTF-8'); ?>" required>

                                <label for="phone">Contact No.</label>
                                <input type="text" name="phone" id="phone" placeholder="Phone number" value="<?php echo htmlspecialchars($this->request->contact_num, ENT_QUOTES, 'UTF-8'); ?>" required>

                            </div>
                            <div class="col span-1-of-2">
                                <label for="reqdate">Required Date
                                    <span>(mm/dd/yy)</span>
                                </label>
                                <input type="date" name="reqdate" id="reqdate" value="<?php echo htmlspecialchars($this->request->required_date, ENT_QUOTES, 'UTF-8'); ?>" required>

                                <label for="dep_time">Departure Time</label>
                                <input type="time" name="dep_time" id="dep_time" value="<?php echo htmlspecialchars($this->request->departure_time, ENT_QUOTES, 'UTF-8'); ?>" required>

                                <label for="pickup">Pickup Point</label>
                                <input type="text" name="pickup" id="pickup" placeholder="Pickup location" value="<?php echo htmlspecialchars($this->request->pick_up_point, ENT_QUOTES, 'UTF-8'); ?>" required>

                                <label for="other_info">Other Info
                                    <span>(optional)</span>
                                </label>
                                <textarea name="other_info" id="other_info" cols="30" rows="3" placeholder="Anything else?"><?php echo htmlspecialchars($this->request->other_info, ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </div>
                        </div>
                        <input type="reset" value="clear fields" class="btn btn-small danger">
                        <input type="submit" value="Update Request" class="btn" name="submit_update_request" >

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
