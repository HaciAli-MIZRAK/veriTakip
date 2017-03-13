<nav class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <?php if($this->session->userdata('userstatus') == 0 || $this->session->userdata('userstatus') == 1 || $this->session->userdata('userstatus') == 2) { ?>
                        <p class="navbar-text navbar-left"><strong><?php echo $lang_footer['demo-user-panel']; ?></strong></p>    
                        <?php } else { ?>
                        <?php  /* Bu Kısım Geçici Olarak Eklenmiştir. */ ; ?>
                        <?php if ($this->session->userdata('userid') == 9) { ?>
                        <p class="AlarmMerkeziKoordinat"></p>
                         <?php  /* end Bu Kısım Geçici Olarak Eklenmiştir. */ ; ?>
                        <?php } else { ?>
                        <p class="navbar-text navbar-left">
                            <small><?php echo $lang_footer['total-car']; ?> </small><strong><i class="total-car fa-white">0</i> - </strong>
                            <small><?php echo $lang_footer['ignition-on']; ?> </small><i class="fa fa-circle fa-greenyellow"></i> -
                            <small><?php echo $lang_footer['ignition-off']; ?> </small><i class="fa fa-circle fa-red"></i> -
                            <small><?php echo $lang_footer['vehicle-idling']; ?> </small><i class="fa fa-circle fa-orange"></i>
                        </p>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <p class="navbar-text navbar-right right-15">
                            <small><?php echo $lang_footer['website-footer']; ?> 2006 - <?php echo date('Y'); ?> 
                                <abbr title="<?php echo $lang_footer['site-and-system-owner']; ?>" class="initialism">
                                    Hacı Ali MIZRAK</abbr> version: 3.0 & <?php echo CI_VERSION; ?> <?php echo $lang_footer['beta-all-rights-reserved']; ?>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </nav><!--/#end navbar navbar-inverse navbar-fixed-bottom -->            
            