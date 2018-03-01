<h2 class="sidenav__heading">FLEET</h2>
<!-- TODO: Make conditions for the pages being active -->
<div class="sidenav__content">
    <nav class="nav">
        <ul>
            <h3 class="sidenav__group--head">Requests: </i></h3>
            <li>
                <a href="<?= URL ?>requests" class="navlink active">Request Management</a>
            </li>
            <li>
                <a href="<?= URL ?>reqhistory" class="navlink">Request History</a>
            </li>
            <h3 class="sidenav__group--head">Vehicles:</i>
            </h3>
            <li>
                <a href="<?= URL ?>vehicles" class="navlink">Vehicle Management</a>
            </li>
            <li>
                <a href="<?= URL ?>maintenance" class="navlink">Maintenance History</a>
            </li>
            <h3 class="sidenav__group--head">Drivers:</h3>
            <li>
                <a href="<?= URL ?>drivers" class="navlink">Driver Management</a>
            </li>
            <h3 class="sidenav__group--head">Users:</h3>
            <li>
                <a href="<?= URL ?>users" class="navlink">User Management</a>
            </li>
            <h3 class="sidenav__group--head">Journeys:</h3>
            <li>
                <a href="<?= URL ?>journeys" class="navlink">Journey Logs</a>
            </li>
            <li>
                <a href="<?= URL ?>login/logout" class="navlink logout">Logout
                    <i class="ion-android-exit icon-small"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>