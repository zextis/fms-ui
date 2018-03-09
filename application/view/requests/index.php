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
                            Request Manager
                        </h2>
                    </div>
                </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-eye-outline icon-small"></i>
                            View Requests</a>
                    </li>
                    <?php if($this->Permission->can('Create/Edit Requests')) :?>
                    <li>
                        <a href="#">
                            <i class="ion-ios-plus-outline icon-small"></i>
                            New Request</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="tab_content">
                    <div id="view" class="tabs_item">
                        <p class="hint">
                            <strong>Hints:</strong><br> - Click on column titles to sort. You can also hold
                            <kbd>Shift</kbd> or
                            <kbd>Ctrl</kbd> and click more titles to add more sorts.
                            <br>
                            - Dates are ordered <mark>mm/dd/yyyy</mark>
                            </p>
                        <div class="tablewrapper">
                            <table class="ptable" id="requestTable">
                                <thead>
                                    <tr>
                                        <th>Request ID</th>
                                        <th>Requested By</th>
                                        <th>Facility</th>
                                        <th>Department</th>
                                        <th>No. of Persons</th>
                                        <th>Required Date</th>
                                        <th>Departure Time</th>
                                        <th>Destination</th>
                                        <th>Contact No.</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($this->requests as $request) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($request->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($request->dept_supervisor, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($request->facility, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($request->department, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($request->number_of_persons, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars(date_format(date_create($request->required_date), "m/d/Y"), ENT_QUOTES, 'UTF-8');
                                         ?></td>
                                        <td><?php echo htmlspecialchars($request->departure_time, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($request->destination, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($request->contact_num, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($request->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="edit">
                                          
                                            <?php $url = ($this->Permission->hasAnyRole(['power-user','approver'])) 
                                            ? URL . 'requests/show/' . $request->id 
                                            : URL . 'requests/edit/' . $request->id; ?>
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

                    <?php if($this->Permission->can('Create/Edit Requests')) :?>
                    <div id="addreq" class="tabs_item">
                        <form action="<?= URL ?>requests/store" method="post" class="form clearfix newform">
                        <p class="hint">
                            <strong>NOTE:</strong> Vehicles are to be used for work-related activities.
                        </p>
                            <span class="in_form">
                                <label for="department">Department</label>
                                <input type="text" name="department" id="department" placeholder="Department" required>
                            </span>

                            <span class="in_form">
                                <label for="destination">Destination</label>
                                <input type="text" name="destination" id="destination" placeholder="Destination" required>
                            </span>

                            <span class="in_form">
                                <label for="num_pers">No. of Persons
                                    <span>(max: 30)</span>
                                </label>
                                <input type="number" value="1" name="num_pers" id="num_pers" min="1" max="30" required>
                            </span>


                            <span class="in_form">
                                <label for="phone">Contact No.</label>
                                <input type="text" name="phone" id="phone" placeholder="Phone number" required>
                            </span>

                            <span class="in_form">
                                <label for="pickup">Pickup Point</label>
                                <input type="text" name="pickup" id="pickup" placeholder="Pickup location" required>
                            </span>


                            <span class="in_form">
                                <label for="reqdate">Required Date
                                    <span>(mm/dd/yy)</span>
                                </label>
                                <input type="date" name="reqdate" id="reqdate" min=<?php echo date("Y-m-d", strtotime("+1day")); ?> required>
                            </span>

                            <span class="in_form">
                                <label for="purpose">Purpose</label>
                                <textarea name="purpose" id="purpose" cols="20" rows="3" placeholder="State the reason for your trip." required></textarea>
                            </span>

                            <span class="in_form">
                                <label for="other_info">Other Info
                                    <span>(optional)</span>
                                </label>
                                <textarea name="other_info" id="other_info" cols="30" rows="3" placeholder="Anything else?"></textarea>
                            </span>

                            <span class="in_form">
                                <label for="dep_time">Departure Time</label>
                                <input type="time" name="dep_time" id="dep_time" required>
                            </span>

                            <span class="form__btn--group">
                                <input type="reset" value="reset" class="btn btn-small btn-reset">
                                <input type="submit" value="Send Request" class="btn btn-submit" name="submit_add_request">
                            </span>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>