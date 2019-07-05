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
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">Edit Vehicle</h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-plus-outline icon-small"></i>
                            Edit Vehicle</a>
                    </li>
                </ul>
                <div class="tab_content">
                    <div id="addreq" class="tabs_item">
                        <form action="<?php echo URL . 'vehicles/update/' . htmlspecialchars($this->vehicle->license_plate, ENT_QUOTES, 'UTF-8'); ?>" method="post" class="form clearfix newform">

                            <span class="in_form">
                                <label for="license_plate">License Plate</label>
                                <input type="text" name="license_plate" value="<?php echo htmlspecialchars($this->vehicle->license_plate, ENT_QUOTES, 'UTF-8');?>" maxlength="6" required>
                            </span>

                            <span class="in_form">
                                <label for="vehicle_type">Vehicle Type</label>
                                <input type="text" name="vehicle_type" id="vehicle_type" placeholder="CAR" value="<?php echo htmlspecialchars($this->vehicle->vehicle_type, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>

                            <span class="in_form">
                                <label for="body_type">Body Type</label>
                                <input type="text" name="body_type" id="body_type" placeholder="Sedan"  value="<?php echo htmlspecialchars($this->vehicle->body_type, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>


                            <span class="in_form">
                                <label for="make">Make</label>
                                <input type="text" name="make" id="make" placeholder="Toyota" value="<?php echo htmlspecialchars($this->vehicle->make, ENT_QUOTES, 'UTF-8');?>"  required>
                            </span>

                            <span class="in_form">
                                <label for="model">Model</label>
                                <input type="text" name="model" id="model" placeholder="Hiace" value="<?php echo htmlspecialchars($this->vehicle->model, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>

                            <span class="in_form">
                                <label for="year">Year</label>
                                <input type="tel" name="year" id="year" maxlength="4" placeholder="2012" value="<?php echo htmlspecialchars($this->vehicle->year, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>

                            <span class="in_form">
                                <label for="transmission">Transmission</label>
                                <input type="text" name="transmission" id="transmission" placeholder="Automatic" value="<?php echo htmlspecialchars($this->vehicle->transmission, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>
                            
                            <span class="in_form">
                                <label for="fuel">Fuel</label>
                                <input type="text" name="fuel" id="fuel" placeholder="Diesel" value="<?php echo htmlspecialchars($this->vehicle->fuel, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>

                            <span class="in_form">
                                <label for="production_year">Production Year</label>
                                <input type="tel" name="production_year" id="production_year"
                                maxlength="4" placeholder="2013" value="<?php echo htmlspecialchars($this->vehicle->production_year, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>

                            <span class="in_form">
                                <label for="facility_id">Facility</label>
                                <select type="text" name="facility_id" id="facility_id" required>
                                <option value="" selected>Choose Facility</option>
                                    <?php foreach ($this->facilities as $facility) : ?>
                                    <option <?php echo $this->vehicle->facility_id==$facility->id ? 'selected' : ""; ?> value="<?= $facility->id?>"><?php echo htmlspecialchars($facility->name, ENT_QUOTES, 'UTF-8'); ?></option>
                                <?php endforeach; ?>
                                </select>
                            </span>
                            <span class="in_form">
                                <label for="engine_number">Engine Number</label>
                                <input type="text" name="engine_number" id="engine_number"
                                 placeholder="52WVC10338" value="<?php echo htmlspecialchars($this->vehicle->engine_number, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>

                            <span class="in_form">
                                <label for="chasis_number">Chassis Number</label>
                                <input type="tel" name="chasis_number" id="chasis_number"
                                 placeholder="999124" value="<?php echo htmlspecialchars($this->vehicle->chasis_number, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>

                            <span class="in_form">
                                <label for="colour">Colour</label>
                                <input type="color" name="colour" id="colour"
                                 placeholder=""  value="<?php echo htmlspecialchars($this->vehicle->colour, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>

                            <span class="in_form">
                                <label for="seating">Seating Capacity</label>
                                <input type="tel" name="seating" id="seating"
                                 placeholder="20" value="<?php echo htmlspecialchars($this->vehicle->seating, ENT_QUOTES, 'UTF-8');?>" maxlength="2" required>
                            </span>

                            <span class="in_form">
                                <label for="cc_rating">CC Rating</label>
                                <input type="tel" name="cc_rating" id="cc_rating"
                                 placeholder="1500" value="<?php echo htmlspecialchars($this->vehicle->cc_rating, ENT_QUOTES, 'UTF-8');?>"  maxlength="4" required>
                            </span>

                            <span class="in_form">
                                <label for="fitness_expiration">Fitness Expiration</label>
                                <input type="date" name="fitness_expiration" id="fitness_expiration"
                                 placeholder="" value="<?php echo htmlspecialchars($this->vehicle->fitness_expiration, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>

                            <span class="in_form">
                                <label for="license_expiration">Licence Expiration</label>
                                <input type="date" name="license_expiration" id="license_expiration"
                                 placeholder="" value="<?php echo htmlspecialchars($this->vehicle->license_expiration, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>

                            <span class="in_form">
                                <label for="next_maintenance">Next Maintenance</label>
                                <input type="date" name="next_maintenance" id="next_maintenance"
                                 placeholder="" value="<?php echo htmlspecialchars($this->vehicle->next_maintenance, ENT_QUOTES, 'UTF-8');?>" required>
                            </span>
                            <br>

                            <span class="in_form">
                                <label for="">Availability: </label>
                                <div class="radio-group">
                                    <label for="status-available">Available</label>
                                    <input <?php echo $this->vehicle->is_available==1 ? 'checked' : ""; ?> type="radio" id="status-available" name="is_available" value="1" checked>
                                    <label for="status-unavailable">Unavailable</label>
                                    <input <?php echo $this->vehicle->is_available==0 ? 'checked' : ""; ?> type="radio" name="is_available" id="status-unavailable" value="0">
                                </div>
                            </span>
                            <span class="in_form">
                                <label for="">Operability: </label>
                                <div class="radio-group">
                                    <label for="status-operable">Operable</label>
                                    <input <?php echo $this->vehicle->is_operable==1 ? 'checked' : ""; ?> type="radio" id="status-operable" name="is_operable" value="1" checked>
                                    <label for="status-inoperable">Inoperable</label>
                                    <input <?php echo $this->vehicle->is_operable==0 ? 'checked' : ""; ?> type="radio" name="is_operable" id="status-inoperable" value="0">
                                </div>
                            </span>
                            
                            <span class="form__btn--group">
                                <input type="reset" value="reset" class="btn btn-small btn-reset">
                                <input type="submit" value="Update Vehicle" class="btn" name="submit_update_vehicle">
                            </span>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
