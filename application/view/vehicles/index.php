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
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">Vehicle Manager</h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-eye-outline icon-small"></i>
                            View Vehicles</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ion-ios-plus-outline icon-small"></i>
                            New Vehicle</a>
                    </li>
                </ul>
                <div class="tab_content">
                    <div id="addreq" class="tabs_item">
                        <p class="hint">
                            <strong>TIP:</strong> Click on column titles to sort. You can also hold
                            <kbd>Shift</kbd> or
                            <kbd>Ctrl</kbd> and click more titles to add more sorts.</p>
                        <div class="tablewrapper">
                            <table class="ptable" id="vehicleTable" border="0">
                                <thead>
                                    <tr>
                                        <th>Plate #</th>
                                        <th>Type</th>
                                        <th>Body</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Year</th>
                                        <th>Facility</th>
                                        <th>Operable</th>
                                        <th>Available</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
<!-- TODO:
change condition back to roles after test -->

                                <tbody>
                                    <?php foreach ($this->vehicles as $vehicle) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($vehicle->license_plate, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($vehicle->vehicle_type, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($vehicle->body_type, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                        <?php echo htmlspecialchars($vehicle->make, ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td>
                                        <?php echo htmlspecialchars($vehicle->model, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                        <?php echo htmlspecialchars($vehicle->year, ENT_QUOTES, 'UTF-8'); ?></td>

                                        <td><?php echo htmlspecialchars($vehicle->facility, ENT_QUOTES, 'UTF-8'); ?></td>

                                        <td>
                                        <?php echo htmlspecialchars($vehicle->is_operable ? 'Yes' : 'No', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <?php
                                            $roles = ($vehicle->body_type) ? explode(',', $vehicle->body_type) : []; ?>
                                        <!-- <ul>
                                            <?php //foreach($roles as $role): ?>
                                            <li><?php // $role ?></li>
                                            <?php //endforeach; ?>
                                        </ul> -->
                                        <td><?php echo htmlspecialchars($vehicle->is_available ? 'Yes' : 'No', ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="edit">
                                            <a href="<?= URL . 'vehicles/edit/' . $vehicle->license_plate ?>" class="opt">
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
                        <form action="<?= URL ?>vehicles/store" method="post" class="form clearfix newform">
                        <span class="in_form">
                                <label for="license_plate">Licence Plate</label>
                                <input type="text" name="license_plate" id="license_plate" placeholder="0001EX" maxlength="6" required>
                            </span>

                            <span class="in_form">
                                <label for="vehicle_type">Vehicle Type</label>
                                <input type="text" name="vehicle_type" id="vehicle_type" placeholder="CAR" required>
                            </span>

                            <span class="in_form">
                                <label for="body_type">Body Type</label>
                                <input type="text" name="body_type" id="body_type" placeholder="Sedan" required>
                            </span>


                            <span class="in_form">
                                <label for="make">Make</label>
                                <input type="text" name="make" id="make" placeholder="Toyota" required>
                            </span>

                            <span class="in_form">
                                <label for="model">Model</label>
                                <input type="text" name="model" id="model" placeholder="Hiace" required>
                            </span>

                            <span class="in_form">
                                <label for="year">Year</label>
                                <input type="tel" name="year" id="year" maxlength="4" placeholder="2012" required>
                            </span>

                            <span class="in_form">
                                <label for="transmission">Transmission</label>
                                <input type="text" name="transmission" id="transmission" placeholder="Automatic" required>
                            </span>
                            
                            <span class="in_form">
                                <label for="fuel">Fuel</label>
                                <input type="text" name="fuel" id="fuel" placeholder="Diesel" required>
                            </span>

                            <span class="in_form">
                                <label for="production_year">Production Year</label>
                                <input type="tel" name="production_year" id="production_year"
                                maxlength="4" placeholder="2013" required>
                            </span>

                            <span class="in_form">
                                <label for="facility_id">Facility</label>
                                <select type="text" name="facility_id" id="facility_id" required>
                                    <option value="">Select facility</option>
                                    <?php foreach ($this->facilities as $facility) : ?> 
                                    <option value="<?= $facility->id ?>"><?php echo htmlspecialchars($facility->name . ' ' . $facility->location, ENT_QUOTES, 'UTF-8'); ?></option> 
                                    <?php endforeach; ?>
                                </select>
                            </span>
                            <span class="in_form">
                                <label for="engine_number">Engine Number</label>
                                <input type="text" name="engine_number" id="engine_number"
                                 placeholder="52WVC10338" required>
                            </span>

                            <span class="in_form">
                                <label for="chasis_number">Chassis Number</label>
                                <input type="tel" name="chasis_number" id="chasis_number"
                                 placeholder="999124" required>
                            </span>

                            <span class="in_form">
                                <label for="colour">Colour</label>
                                <input type="color" name="colour" id="colour"
                                 placeholder="" required>
                            </span>

                            <span class="in_form">
                                <label for="seating">Seating Capacity</label>
                                <input type="tel" name="seating" id="seating"
                                 placeholder="20" maxlength="2" required>
                            </span>

                            <span class="in_form">
                                <label for="cc_rating">CC Rating</label>
                                <input type="tel" name="cc_rating" id="cc_rating"
                                 placeholder="1500" maxlength="4" required>
                            </span>

                            <span class="in_form">
                                <label for="fitness_expiration">Fitness Expiration</label>
                                <input type="date" name="fitness_expiration" id="fitness_expiration"
                                 placeholder="" required>
                            </span>

                            <span class="in_form">
                                <label for="license_expiration">Licence Expiration</label>
                                <input type="date" name="license_expiration" id="license_expiration"
                                 placeholder="" required>
                            </span>

                            <span class="in_form">
                                <label for="next_maintenance">Next Maintenance</label>
                                <input type="date" name="next_maintenance" id="next_maintenance"
                                 placeholder="" required>
                            </span>
                            <br>

                            <span class="in_form">
                                <label for="is_available">Availability</label>
                                <input type="radio" name="is_available" value="1" checked>&nbsp;&nbsp;Available &nbsp;
                                <input type="radio" name="is_available" value="0">&nbsp;&nbsp;Unavailable
                            </span>

                            <span class="in_form">
                                <label for="is_operable">Operability</label>
                                <input type="radio" name="is_operable" value="1" checked>&nbsp;&nbsp;Operable &nbsp;
                                <input type="radio" name="is_operable" value="0">&nbsp;&nbsp;Inoperable
                            </span>
                            
                            <span class="form__btn--group">
                                <input type="reset" value="reset" class="btn btn-small btn-reset">
                                <input type="submit" value="Send Vehicle" class="btn" name="submit_add_vehicle">
                            </span>
                            
                            <!-- <span class="in_form1">
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
                                <input type="text" name="email" id="email" placeholder="vehicle@mail.com" required>
                            </span>

                            <span class="in_form1">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="" required>
                            </span>

                            <span class="in_form1">
                                <label for="is_active">Active</label>
                                <input type="checkbox" name="is_active" id="is_active" placeholder="">
                            </span> -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>