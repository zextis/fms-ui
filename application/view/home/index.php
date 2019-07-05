<body id="main">
<div class="container">
    <header class="header">
        <div class="header__text-box">
            <h1 class="header__heading animated fadeInDown">
                Fleet Management System
            </h1>
        </div>
    </header>

    <section class="content">
        <div class="row not-full">
            <div class="col span-3-of-4 light-text">
            <caption><h2 class="content__heading--secondary light-text">Currently Approved Requests</h2></caption>
                <table class="ptable matbox" id="requestTable" border="0">
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
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($this->requests): 
                        foreach ($this->requests as $request) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($request->id, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($request->dept_supervisor, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($request->facility, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($request->department, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($request->number_of_persons, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($request->required_date, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($request->departure_time, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($request->destination, ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                        <?php endforeach; else:?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="10">NO RESULTS</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="col span-1-of-4 signIn">
                <h2 class="content__heading--secondary light-text">Sign In</h2>

                <form action="<?php echo URL; ?>login/login" method="post" class="form sign-form matbox clearfix">

                    <!-- echo out the system feedback (error and success messages) -->
                    <?php $this->renderFeedbackMessages(); ?>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="yourlogin@example.com" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="*********" required>

                    <input type="submit" value="Sign In" class="btn animated infinite pulse">
                </form>
            </div>
        </div>
    </section>  
</div>
