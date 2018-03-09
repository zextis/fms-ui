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
                    <h2 class="content__heading--secondary managetext animated fadeInLeft">Your Request History
                    </h2>
                </div>
            </header>
            <div class="row tab">
                <ul class="tabs">
                    <li>
                        <a href="#">
                            <i class="ion-ios-clock-outline icon-small"></i>
                            History</a>
                    </li>
                </ul>
                <div class="tab_content">
                <div id="view" class="tabs_item">
                        <div class="tablewrapper">
                            <table class="ptable" id="requestTable" border="0">
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
                </div>
            </div>
        </div>
    </div>
</div>
