<h2 class="sidenav__heading">FLEET</h2>
<!-- TODO: Make conditions for the pages being active -->
<div class="sidenav__content">
    <nav class="nav">
        <ul>
            <h3 class="sidenav__group--head">Requests: </i></h3>
            <?php if($this->Permission->hasAnyRole(['power-user', 'supervisor'])) : ?>
            <li>
                <a href="<?= URL ?>requests" class="navlink <?= !empty($this->which_ctrl) && $this->which_ctrl == 'requests' ? 'active' : ''; ?>">Request Management</a>
            </li>
            <li>
                <a href="<?= URL ?>reqhistory" class="navlink <?= !empty($this->which_ctrl) && $this->which_ctrl == 'reqhistory' ? 'active' : ''; ?>">Request History</a>
            </li>
            <?php endif; ?>

            <?php if($this->Permission->hasAnyRole(['power-user'])) : ?>
            <h3 class="sidenav__group--head">Vehicles:</i>
            </h3>
            <li>
                <a href="<?= URL ?>vehicles" class="navlink <?= !empty($this->which_ctrl) && $this->which_ctrl == 'vehicles' ? 'active' : ''; ?>">Vehicle Management</a>
            </li>
            <li>
                <a href="<?= URL ?>maintenance" class="navlink <?= !empty($this->which_ctrl) && $this->which_ctrl == 'maintenance' ? 'active' : ''; ?>">Maintenance History</a>
            </li>
            <?php endif; ?>

            <?php if($this->Permission->hasAnyRole(['power-user'])) : ?>
            <h3 class="sidenav__group--head">Drivers:</h3>
            <li>
                <a href="<?= URL ?>drivers" class="navlink <?= !empty($this->which_ctrl) && $this->which_ctrl == 'drivers' ? 'active' : ''; ?>">Driver Management</a>
            </li>
            <?php endif; ?>

            <?php if($this->Permission->hasAnyRole(['power-user'])) : ?>
            <h3 class="sidenav__group--head">Users:</h3>
            <li>
                <a href="<?= URL ?>users" class="navlink <?= !empty($this->which_ctrl) && $this->which_ctrl == 'users' ? 'active' : ''; ?>">User Management</a>
                <a href="<?= URL ?>permissions" class="navlink <?= !empty($this->which_ctrl) && $this->which_ctrl == 'permissions' ? 'active' : ''; ?>">Permissions</a>
                <a href="<?= URL ?>roles" class="navlink <?= !empty($this->which_ctrl) && $this->which_ctrl == 'roles' ? 'active' : ''; ?>">Roles</a>
            </li>
            <?php endif; ?>

            <?php if($this->Permission->hasAnyRole(['power-user'])) : ?>
            <h3 class="sidenav__group--head">Journeys:</h3>
            <li>
                <a href="<?= URL ?>journeys" class="navlink <?= !empty($this->which_ctrl) && $this->which_ctrl == 'journeys' ? 'active' : ''; ?>">Journey Logs</a>
            </li>
            <?php endif; ?>
            
            <li>
                <a href="<?= URL ?>login/logout" class="navlink logout">Logout
                    <i class="ion-android-exit icon-small"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>