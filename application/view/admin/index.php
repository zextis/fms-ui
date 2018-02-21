<body>
<div class="row">
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div class="col span-2-of-12 side-nav clearfix matbox">
            <h2 class="sidenav__heading">FLEET</h2>
            <div class="sidenav__content">
                <nav class="nav">
                    <ul>
                        <h3 class="sidenav__group--head">Requests: </i>
                        </h3>
                        <li>
                            <a href="#" class="navlink active">Request Management</a>
                        </li>
                        <li>
                            <a href="#" class="navlink">Request History</a>
                        </li>
                        <h3 class="sidenav__group--head">Vehicles:</i>
                        </h3>
                        <li>
                            <a href="#" class="navlink">Vehicle Management</a>
                        </li>
                        <li>
                            <a href="#" class="navlink">Maintenance History</a>
                        </li>
                        <h3 class="sidenav__group--head">Drivers:</h3>
                        <li>
                            <a href="#" class="navlink">Driver Management</a>
                        </li>
                        <h3 class="sidenav__group--head">Users:</h3>
                        <li>
                            <a href="#" class="navlink">User Management</a>
                        </li>
                        <h3 class="sidenav__group--head">Journeys:</h3>
                        <li>
                            <a href="#" class="navlink">Journey Logs</a>
                        </li>
                        <li>
                            <a href="<?= URL ?>login/logout" class="navlink logout">Logout
                                <i class="ion-android-exit icon-small"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
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
                                    <tr>
                                        <td class="id">0000001</td>
                                        <td class="user">john Frescoe</td>
                                        <td class="fac">May Pen</td>
                                        <td class="dep">SRC</td>
                                        <td class="nop">23</td>
                                        <td class="reqdate">02/11/2018</td>
                                        <td class="deptime">5:00PM</td>
                                        <td class="dest">Uganda</td>
                                        <td class="contno">4625789</td>
                                        <td class="driver">De Qween</td>
                                        <td class="status" value="approved">approved</td>
                                        <td class="edit">
                                            <a href="" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="id">0000002</td>
                                        <td class="user">Frescoe Merlot</td>
                                        <td class="fac">MHD</td>
                                        <td class="dep">MIS</td>
                                        <td class="nop">8</td>
                                        <td class="reqdate">02/19/2018</td>
                                        <td class="deptime">2:00PM</td>
                                        <td class="dest">Willowgate</td>
                                        <td class="contno">4625789</td>
                                        <td class="driver">Samothy Jones</td>
                                        <td class="status" value="pending">pending</td>
                                        <td class="edit">
                                            <a href="" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="id">0000003</td>
                                        <td class="user">Marc Jacobs</td>
                                        <td class="fac">Santa Cruz</td>
                                        <td class="dep">HR</td>
                                        <td class="nop">13</td>
                                        <td class="reqdate">02/23/2018</td>
                                        <td class="deptime">12:00PM</td>
                                        <td class="dest">Johns Reed</td>
                                        <td class="contno">4623489</td>
                                        <td class="driver">Knuckles</td>
                                        <td class="status" value="disapproved">disapproved</td>
                                        <td class="edit">
                                            <a href="" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="id">0000004</td>
                                        <td class="user">Jimothy Hubert</td>
                                        <td class="fac">Play Pen</td>
                                        <td class="dep">Accounts</td>
                                        <td class="nop">6</td>
                                        <td class="reqdate">03/12/2018</td>
                                        <td class="deptime">9:00AM</td>
                                        <td class="dest">Fridays</td>
                                        <td class="contno">2334463</td>
                                        <td class="driver">Shlerpy Derpy</td>
                                        <td class="status" value="pending">pending</td>
                                        <td class="edit">
                                            <a href="" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="id">0000005</td>
                                        <td class="user">Leroy Jenkins</td>
                                        <td class="fac">Percy Junior</td>
                                        <td class="dep">SRC</td>
                                        <td class="nop">14</td>
                                        <td class="reqdate">02/15/2018</td>
                                        <td class="deptime">3:00PM</td>
                                        <td class="dest">Linstead Hospital</td>
                                        <td class="contno">5682189</td>
                                        <td class="driver">Howie</td>
                                        <td class="status">pending</td>
                                        <td class="edit">
                                            <a href="" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="id">0000006</td>
                                        <td class="user">Francis Numan</td>
                                        <td class="fac">Southern Regional</td>
                                        <td class="dep">Custodial</td>
                                        <td class="nop">6</td>
                                        <td class="reqdate">04/13/2018</td>
                                        <td class="deptime">11:15PM</td>
                                        <td class="dest">May Pen Health Centre</td>
                                        <td class="contno">9895372</td>
                                        <td class="driver">Trevor Jones</td>
                                        <td class="status">approved</td>
                                        <td class="edit">
                                            <a href="" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="id">0000001</td>
                                        <td class="user">john Frescoe</td>
                                        <td class="fac">May Pen</td>
                                        <td class="dep">SRC</td>
                                        <td class="nop">23</td>
                                        <td class="reqdate">02/11/2018</td>
                                        <td class="deptime">5:00PM</td>
                                        <td class="dest">Uganda</td>
                                        <td class="contno">4625789</td>
                                        <td class="driver">De Qween</td>
                                        <td class="status">approved</td>
                                        <td class="edit">
                                            <a href="" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="id">0000001</td>
                                        <td class="user">john Frescoe</td>
                                        <td class="fac">May Pen</td>
                                        <td class="dep">SRC</td>
                                        <td class="nop">23</td>
                                        <td class="reqdate">02/11/2018</td>
                                        <td class="deptime">5:00PM</td>
                                        <td class="dest">Uganda</td>
                                        <td class="contno">4625789</td>
                                        <td class="driver">De Qween</td>
                                        <td class="status">approved</td>
                                        <td class="edit">
                                            <a href="" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="id">0000001</td>
                                        <td class="user">john Frescoe</td>
                                        <td class="fac">May Pen</td>
                                        <td class="dep">SRC</td>
                                        <td class="nop">23</td>
                                        <td class="reqdate">02/11/2018</td>
                                        <td class="deptime">5:00PM</td>
                                        <td class="dest">Uganda</td>
                                        <td class="contno">4625789</td>
                                        <td class="driver">De Qween</td>
                                        <td class="status">approved</td>
                                        <td class="edit">
                                            <a href="" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="id">0000001</td>
                                        <td class="user">john Frescoe</td>
                                        <td class="fac">May Pen</td>
                                        <td class="dep">SRC</td>
                                        <td class="nop">23</td>
                                        <td class="reqdate">02/11/2018</td>
                                        <td class="deptime">5:00PM</td>
                                        <td class="dest">Uganda</td>
                                        <td class="contno">4625789</td>
                                        <td class="driver">De Qween</td>
                                        <td class="status">approved</td>
                                        <td class="edit">
                                            <!-- <button type="submit" class="ion-edit btn-small"></button> -->
                                            <a href="" class="edit">
                                                <i class="ion-edit btn-small"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="addreq" class="tabcontent">
                    <form action="" method="get" class="form sign-form matbox clearfix">
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
                        <input type="submit" value="Send Request" class="btn">

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>