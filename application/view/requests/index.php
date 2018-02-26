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
                    <button class="tablink" onclick="openPage('view', this, 'white')" id="defaultOpen">
                        View Requests
                        <i class="ion-ios-eye-outline icon-small"></i>
                    </button>
                </div>
                <div class="col span-1-of-2 tab">
                    <button class="tablink" onclick="openPage('addreq', this, 'white')">
                        New Request
                        <i class="ion-ios-plus-outline icon-small"></i>
                    </button>
                </div>
                <div id="view" class="tabcontent">

                    <div id="reqList">
                        <input type="text" class="search" placeholder="Type here to start searching...">
                        <button class="btn btn-small danger" onclick="resetReqList();">
                            reset
                        </button>
                        <button class="btn btn-small sort" data-sort="reqdate">
                            sort required date
                        </button>
                        <label for="status-all">
                            <input type="radio" name="status" id="status-all" class="filter-all" value="all" checked> All
                        </label>
                        <label for="status-approved">
                            <input type="radio" name="status" id="status-approved" class="filter" value="approved"> Approved
                        </label>
                        <label for="status-pending">
                            <input type="radio" name="status" id="status-pending" class="filter" value="pending">Pending
                        </label>
                        <label for="status-disapproved">
                            <input type="radio" name="status" id="status-disapproved" class="filter" value="disapproved">Disapproved
                        </label>
                        <!-- <table class="reqtable fixedtable">
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
                                <th>Driver</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </table> -->
                        <div class="tablewrapper">
                            <div class="no-result animated infinite flash">No Results</div>
                            <table class="reqtable" border="0">
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
                                        <th>Driver</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>

                                <tbody class="list">
                                <?php foreach ($this->requests as $request) : ?>
                                    <tr>
                                        <td class="id"><?php echo htmlspecialchars($request->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="user"><?php echo htmlspecialchars($request->dept_supervisor, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="fac"><?php echo htmlspecialchars($request->facility, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="dep"><?php echo htmlspecialchars($request->department, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="nop"><?php echo htmlspecialchars($request->number_of_persons, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="reqdate"><?php echo htmlspecialchars($request->required_date, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="deptime"><?php echo htmlspecialchars($request->departure_time, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="dest"><?php echo htmlspecialchars($request->destination, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="contno"><?php echo htmlspecialchars($request->contact_num, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="driver"><?php if (isset($request->driver)) echo htmlspecialchars($request->driver, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="status" value="approved"><?php echo htmlspecialchars($request->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="edit">
                                            <a href="<?= URL ?>requests/edit/<?= $request->id ?>" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="addreq" class="tabcontent">
                    <form action="<?= URL ?>requests/store" method="post" class="form sign-form matbox clearfix">
                        <input type="hidden" name="facility_id" value="1">
                        <!-- <h2 class="form__title">New Request</h2> -->
                        <div class="row">
                            <div class="col span-1-of-2">
                                <label for="department">Department</label>
                                <input type="text" name="department" id="department" placeholder="Department" required>

                                <label for="num_pers">Number of Persons
                                    <span>(maximum: 30)</span>
                                </label>
                                <input type="number" value="1" name="num_pers" id="num_pers" min="1" max="30" required>

                                <label for="purpose">Purpose</label>
                                <textarea name="purpose" id="purpose" cols="20" rows="2" placeholder="State the reason for your trip." required></textarea>

                                <label for="destination">Destination</label>
                                <input type="text" name="destination" id="destination" placeholder="Destination" required>

                                <label for="phone">Contact No.</label>
                                <input type="text" name="phone" id="phone" placeholder="Phone number" required>

                            </div>
                            <div class="col span-1-of-2">
                                <label for="reqdate">Required Date
                                    <span>(mm/dd/yy)</span>
                                </label>
                                <input type="date" name="reqdate" id="reqdate" required>

                                <label for="dep_time">Departure Time</label>
                                <input type="time" name="dep_time" id="dep_time" required>

                                <label for="pickup">Pickup Point</label>
                                <input type="text" name="pickup" id="pickup" placeholder="Pickup location" required>

                                <label for="other_info">Other Info
                                    <span>(optional)</span>
                                </label>
                                <textarea name="other_info" id="other_info" cols="30" rows="3" placeholder="Anything else?"></textarea>
                            </div>
                        </div>
                        <input type="reset" value="clear fields" class="btn btn-small danger">
                        <input type="submit" value="Send Request" class="btn" name="submit_add_request" >

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>