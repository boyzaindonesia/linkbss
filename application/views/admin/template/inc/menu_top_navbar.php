<div class="top-navbar-inner">
    
    <div class="logo-brand <?php echo ($this->jCfg['user']['color']!=''?$this->jCfg['user']['color'].'-color':'') ?>">
        <h3><a href="<?php echo site_url();?>" target="_blank"><?php echo get_name_app("configuration_name");?></a></h3>
    </div>
    
    <div class="top-nav-content">
        
        <!-- Begin button sidebar left toggle -->
        <div class="btn-collapse-sidebar-left">
            <i class="fa fa-long-arrow-right icon-dinamic"></i>
        </div>
        <!-- End button sidebar left toggle -->

        <!-- Begin button sidebar right toggle -->
        <div class="btn-collapse-sidebar-right">
            <i class="fa fa-comments"></i>
        </div>
        <!-- End button sidebar right toggle -->

        <div class="collapse navbar-collapse" id="main-fixed-nav">
            <!-- <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </form> -->
            
        </div>
        
        <!-- Begin button nav toggle -->
        <div class="btn-collapse-nav" data-toggle="collapse" data-target="#main-fixed-nav">
            <i class="fa fa-plus icon-plus"></i>
        </div>
        <!-- End button nav toggle -->
        
        <!-- Begin user session nav -->
        <ul class="nav-user navbar-right clearfix">
            <li class="nav-info-login">
                <h4><?php echo $this->jCfg['user']['level'];?></h4>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo get_image(base_url()."assets/collections/photo/thumb/".get_user_photo($this->jCfg['user']['id']));?>" class="avatar img-circle" alt="">
                    Hi, <strong><?php echo $this->jCfg['user']['fullname'];?></strong>
                </a>
                <ul class="dropdown-menu square <?php echo ($this->jCfg['user']['color']!=''?$this->jCfg['user']['color']:'') ?> margin-list-rounded with-triangle">
                    <li><a href="<?php echo site_url("admin/me/profile");?>">Profile Saya</a></li>
                    <?php if($this->jCfg['user']['level']!="grader"){?>
                    <li><a href="<?php echo site_url("admin/me/change_password");?>">Ubah Password</a></li>
                    <?php } ?>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url("auth/out");?>">Log out</a></li>
                </ul>
            </li>
        </ul>
        <!-- End user session nav -->
        
        <div class="collapse navbar-collapse" id="main-fixed-nav">

        </div>
        <!-- End Collapse menu nav -->

    </div>
</div>