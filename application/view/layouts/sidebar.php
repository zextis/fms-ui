<h2 class="sidenav__heading">FLEET</h2>
<!-- TODO: Make conditions for the pages being active -->
<?php 
            use Mini\Core\Session;
            use Mini\Model\User;
            if(Session::userIsLoggedIn() ) :
            ?>
            <p class="signed"><span><i class="ion-record"></i></span>  <?php echo Session::get('username'); ?></p>
            <p class="signed"><?php echo Session::get('facility'); ?></p>
            <?php endif; ?>

<div class="sidenav__content">
    <nav class="nav">
        <ul>
            <h3 class="sidenav__group--head">Requests: </i></h3>
            <?php if($this->Permission->hasAnyRole(['power-user', 'supervisor','approver'])) : ?>
            <li>
                <a href="<?php echo URL; ?>requests" class="navlink <?php echo !empty($this->which_ctrl) && $this->which_ctrl == 'requests' ? 'active' : ''; ?>">Request Manager</a>
            </li>
            <li>
                <a href="<?php echo URL; ?>reqhistory" class="navlink <?php echo !empty($this->which_ctrl) && $this->which_ctrl == 'reqhistory' ? 'active' : ''; ?>">Request History</a>
            </li>
            <?php endif; ?>

            <?php if($this->Permission->hasAnyRole(['power-user','data-entry'])) : ?>
            <h3 class="sidenav__group--head">Vehicles:</i>
            </h3>
            <li>
                <a href="<?php echo URL; ?>vehicles" class="navlink <?php echo !empty($this->which_ctrl) && $this->which_ctrl == 'vehicles' ? 'active' : ''; ?>">Vehicle Manager</a>
            </li>
            <!-- <li>
                <a href="<?php echo URL; ?>maintenance" class="navlink <?php echo !empty($this->which_ctrl) && $this->which_ctrl == 'maintenance' ? 'active' : ''; ?>">Maintenance</a>
            </li> -->
            <?php endif; ?>

            <?php if($this->Permission->hasAnyRole(['power-user', 'data-entry'])) : ?>
            <h3 class="sidenav__group--head">Drivers:</h3>
            <li>
                <a href="<?php echo URL; ?>drivers" class="navlink <?php echo !empty($this->which_ctrl) && $this->which_ctrl == 'drivers' ? 'active' : ''; ?>">Driver Manager</a>
            </li>
            <?php endif; ?>

            <?php if ($this->Permission->hasAnyRole(['power-user'])) : ?>
            <h3 class="sidenav__group--head">Users:</h3>
            <li>
                <a href="<?php echo URL; ?>users" class="navlink <?php echo !empty($this->which_ctrl) && $this->which_ctrl == 'users' ? 'active' : ''; ?>">User Manager</a>
                <a href="<?php echo URL; ?>permissions" class="navlink <?php echo !empty($this->which_ctrl) && $this->which_ctrl == 'permissions' ? 'active' : ''; ?>">Permissions</a>
                <a href="<?php echo URL; ?>roles" class="navlink <?php echo !empty($this->which_ctrl) && $this->which_ctrl == 'roles' ? 'active' : ''; ?>">Roles</a>
            </li>
            <?php endif; ?>

            <?php if($this->Permission->hasAnyRole(['power-user'])) : ?>
            <h3 class="sidenav__group--head">Journeys:</h3>
            <li>
                <a href="<?php echo URL; ?>journeys" class="navlink <?php echo !empty($this->which_ctrl) && $this->which_ctrl == 'journeys' ? 'active' : ''; ?>">Journey Logs</a>
            </li>
            <?php endif; ?>
            
            <li>
                <a href="<?php echo URL; ?>login/logout" class="navlink logout">Logout
                    <i class="ion-android-exit icon-small"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>