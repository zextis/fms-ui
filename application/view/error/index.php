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
                        Fleet Management System
                    </h2>
                </div>
            </header>
            <div class="row container">
                
                <p>Uh-oh, Something went wrong! Please try again later.</p>
                
            </div>
        </div>
    </div>
</div>