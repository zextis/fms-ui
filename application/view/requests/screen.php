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
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">Screening Request #<?php echo htmlspecialchars($this->request->id, ENT_QUOTES, 'UTF-8'); ?> 
                    </h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-clipboard icon-small"></i>
                            Screen Request</a>
                    </li>
                </ul>
                <div class="tab_content">
                    <div id="addreq" class="tabs_item">
                        <form action="<?php echo URL . 'requests/screen/' . htmlspecialchars($this->request->id, ENT_QUOTES, 'UTF-8'); ?>" method="post" class="form clearfix newform">
                        <!-- TODO:ADD NINJA CODE TO MAKE THIS DO MAGIC -->
                        <input type="hidden" name="facility_id" value="1">
                            <span class="in_form">
                                <label for="department">Department</label>
                                <input type="text" name="department" id="department" placeholder="Department" value="<?php echo htmlspecialchars($this->request->department, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                            </span>

                            <span class="in_form">
                                <label for="destination">Destination</label>
                                <input type="text" name="destination" id="destination" placeholder="Destination" value="<?php echo htmlspecialchars($this->request->destination, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                            </span>

                            <span class="in_form">
                                <label for="num_pers">No. of Persons
                                    <span>(max: 30)</span>
                                </label>
                                <input type="number" name="num_pers" id="num_pers" min="1" max="30" value="<?php echo htmlspecialchars($this->request->number_of_persons, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                            </span>


                            <span class="in_form">
                                <label for="phone">Contact No.</label>
                                <input type="text" name="phone" id="phone" placeholder="Phone number" value="<?php echo htmlspecialchars($this->request->contact_num, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                            </span>

                            <span class="in_form">
                                <label for="pickup">Pickup Point</label>
                                <input type="text" name="pickup" id="pickup" placeholder="Pickup location" value="<?php echo htmlspecialchars($this->request->pick_up_point, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                            </span>


                            <span class="in_form">
                                <label for="reqdate">Required Date
                                    <span>(mm/dd/yy)</span>
                                </label>
                                <input type="date" name="reqdate" id="reqdate" value="<?php echo htmlspecialchars($this->request->required_date, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                            </span>

                            <span class="in_form">
                                <label for="purpose">Purpose</label>
                                <textarea name="purpose" id="purpose" cols="20" rows="3" placeholder="State the reason for your trip." disabled><?php echo htmlspecialchars($this->request->purpose_of_trip, ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </span>

                            <span class="in_form">
                                <label for="other_info">Other Info
                                    <span>(optional)</span>
                                </label>
                                <textarea name="other_info" id="other_info" cols="30" rows="3" placeholder="Anything else?" disabled><?php echo htmlspecialchars($this->request->other_info, ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </span>

                            <span class="in_form">
                                <label for="dep_time">Departure Time</label>
                                <input type="time" name="dep_time" id="dep_time" value="<?php echo htmlspecialchars($this->request->departure_time, ENT_QUOTES, 'UTF-8'); ?>" disabled>
                            </span>
                            <hr>
                            <h2 class="content__heading--secondary">Approve or Reject</h2>
                            <span class="in_form">
                                <div class="radio-group">
                                    <label for="status-approved">Approve</label>
                                    <input type="radio" id="status-approved" name="status" value="Approved" required>
                                    <label for="status-rejected">Reject</label>
                                    <input type="radio" name="status" id="status-rejected" value="Rejected" required>
                                </div>
                            </span>
                             <span class="condopt form__hidden">
                                <label for="driver_opt">Driver: </label>
                                <select id="driver_opt" name="driver_id">
                                    <option value="" selected>Choose Driver</option>
                                    <?php foreach ($this->drivers as $driver) : ?>
                                    <option value="<?= $driver->id?>"><?php echo htmlspecialchars($driver->first_name." ".$driver->last_name, ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php endforeach; ?>
                                </select>
                            </span>

                            <span class="condopt long-opt form__hidden">
                                <label for="vehicle_opt">Vehicle: </label>
                                <select id="vehicle_opt" name="license_plate">
                                <option value="" selected>Choose Vehicle</option>
                                <?php foreach ($this->vehicles as $vehicle) : ?>
                                    <option value="<?= $vehicle->license_plate?>"><?php echo htmlspecialchars($vehicle->license_plate." | ". $vehicle->make." | ".$vehicle->model." | ".$vehicle->vehicle_type , ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php endforeach; ?>
                                </select>
                            </span>

                            <span class="comment form__hidden">
                                <label for="comments">Rejection Comments:</label>
                                <textarea name="comments" id="comments" cols="20" rows="3" placeholder="Write here"></textarea>
                            </span>


                            <span class="form__btn--group">
                                <input type="submit" value="Save Changes" class="btn btn-submit" name="screen_request">
                                <div class="reply form__hidden form__msg form__msg--error">
                                </div>
                                <div class="reply-two form__hidden form__msg form__msg--error">
                                </div>
                            </span>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
