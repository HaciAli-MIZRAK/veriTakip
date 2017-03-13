<?php 
/*
    No: 6 Administrator
 *  No: 5 Gurup Lideri
 *  No: 4 Gurup Personeli
 *  No: 3 
 *   
 */
?>
<nav class="navbar navbar-default fa-box-shadow navbar-fixed-top" id="userIdxz" title="<?php echo $this->session->userdata('userid'); ?>" rel="<?php echo $this->session->userdata('userstatus'); ?>">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('takip'); ?>"><strong class="fa-shadow"><?php echo $lang_header['navbar-brand']; ?></strong></a>
                    <?php if (current_url() != base_url('takip')) { ?>
                    <a class="navbar-brand" href="<?php echo base_url('takip'); ?>"><i class="glyphicon glyphicon-screenshot fa-lg"></i></a>
                    <?php } else { ?>
                    <a class="navbar-brand" id="aktif" title="<?php echo $lang_header['full-screen']; ?>" href="#"><i class="glyphicon glyphicon-fullscreen fa-lg"></i>&nbsp;&nbsp;</a>
                    <button id="fotografCheck" class="navbar-brand btn btn-link" title="Fotoğraf Çekin CAM1"><i id="disabled" alt="cam1" class="glyphicon glyphicon-camera fa-green fa-lg"></i></button>
                    <?php if ($this->session->userdata('userid') == 12) { ?>
                    <button id="fotografCheck2" class="navbar-brand btn btn-link" title="Fotoğraf Çekin CAM2"><i id="disabled2" alt="cam2" class="glyphicon glyphicon-camera fa-green fa-lg"></i></button>
                    <?php } ?>
                    <?php if ($this->session->userdata('userid') == 12) { ?>
                    <button id="AtcMotorBlokajButton" class="navbar-brand btn-link" style="display: none; text-decoration: none;"><i id="AtcMotorBlokaj" class="icon-motorblokaj-icon-siyah2 fa-green fa-3x"></i></button>
                    <?php } ?>
                    <div class="navbar-brand fa-flashx fa-red" id="DeviceControl" data-wow-delay=".1s" style="font-size: 0.9em;"></div>
                    <div class="navbar-brand fa-green" id="AddessInfoPanel" style="font-size: 0.9em;"></div>
                    <?php } ?>
                </div>
                <?php if (current_url() == base_url('takip/assanpages')) { ?>
                <!-- assan search alanı -->
                <div class="navbar-form navbar-left container-fluid">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="icon-bluetooth fa-bluetotth-color"></i>
                        </div>
                        <input type="text" class="form-control" id="bluetooth-search-box-assan" placeholder="Bluetooth Cihaz Ara" />
                    </div><!-- /.input group -->
                </div>
                <!-- # assan search alanı -->
                <?php } ?>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right fa-active navbar-static-top">
                        <p class="navbar-text navbar-left zoom-level"><strong><?php echo $lang_header['Zoom-Level']; ?> : ? </strong></p>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#"><strong><?php echo $lang_header['welcome-user']; ?></strong><i class="glyphicon glyphicon-menu-right"></i></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <?php echo $this->session->userdata('username'); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url('takip/profile'); ?>"><i class="fa fa-user fa-green fa-lg"></i>&nbsp;&nbsp; <?php echo $lang_header['profile-panel']; ?></a></li>
                                <?php if ($this->session->userdata('userstatus') == 6) { ?>
                                <li><a href="<?php echo base_url('takip/addproduct'); ?>"><i class="fa fa-plus fa-green fa-lg"></i>&nbsp;&nbsp; <?php echo $lang_header['product-list']; ?></a></li>
                                <li><a href="#"><i class="fa fa-cog fa-green fa-lg"></i>&nbsp;&nbsp; Admin Paneli</a></li>
                                <li class="divider"></li>
                                <?php if ($this->session->userdata('userid') == 11) { ?>
                                <li><a href="<?php echo base_url('takip/uludagpages'); ?>"><i class="fa fa-list-alt fa-green fa-lg"></i>&nbsp;&nbsp; Uludağ Paneli</a></li>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($this->session->userdata('userid') == 11) { ?>
                                <li><a href="<?php echo base_url('takip/uludagpages'); ?>"><i class="fa fa-list-alt fa-green fa-lg"></i>&nbsp;&nbsp; Uludağ Paneli</a></li>
                                <?php } ?>
                                <?php if ($this->session->userdata('userstatus') == 4) { ?>
                                <li><a href="<?php echo base_url('takip/addproduct'); ?>"><i class="fa fa-plus fa-green fa-lg"></i>&nbsp;&nbsp; <?php echo $lang_header['product-list']; ?></a></li>
                                <li><a href="<?php echo base_url('takip/assanpages'); ?>"><i class="fa fa-list fa-green fa-lg"></i>&nbsp;&nbsp; Sicpa PCC</a></li>
                                <li><a href="<?php echo base_url('takip/assanareas'); ?>"><i class="fa fa-map fa-green fa-lg"></i>&nbsp;&nbsp; Assan Bölgeler</a></li>
                                <?php } ?>
                                <?php if ($this->session->userdata('userstatus') == 6) { ?>
                                <li><a href="<?php echo base_url('takip/xmetrepages'); ?>"><i class="fa fa-sort-amount-asc fa-green fa-lg"></i>&nbsp;&nbsp; xMetre Sayfası</a></li>
                                <?php } ?>
                                <?php if ($this->session->userdata('userstatus') == 5) { ?>
                                <li><a href="<?php echo base_url('takip/addproduct'); ?>"><i class="fa fa-plus fa-green fa-lg"></i>&nbsp;&nbsp; <?php echo $lang_header['product-list']; ?></a></li>
                                <?php if ($this->session->userdata('userid') == 4 || $this->session->userdata('userid') == 5 || $this->session->userdata('userid') == 13) { ?>
                                <li><a href="<?php echo base_url('takip/xmetrepages'); ?>" ><i class="fa fa-sort-amount-asc fa-green fa-lg"></i>&nbsp;&nbsp; xMetre Sayfası</a></li>
                                <?php } ?>
                                <?php } ?>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url('pages/logout'); ?>"><i class="fa fa-power-off fa-red fa-lg"></i>&nbsp;&nbsp; <?php echo $lang_header['log-out']; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav><!-- /.nav -->
        