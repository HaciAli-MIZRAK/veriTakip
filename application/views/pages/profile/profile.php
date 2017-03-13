<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-bottom-50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px;"></div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <header><h2 class="left-h2" style="border-bottom: 1px #000 solid; padding-bottom: 10px;"><?php echo $lang_profile['my-control-panel']; ?> </h2></header>
                <?php echo $this->session->userdata('userregistered'); ?>
                <h4>Şifrenizi Güncelleyin</h4>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2 style="border-bottom: 1px #000 dashed; margin-bottom: 15px;"></h2>
                </div>
                <header><h4 class="left-h2" style="border-bottom: 1px #000 solid; padding-bottom: 10px;"><?php echo $lang_profile['my-position']; ?> </h4> <button id="profile-fullscreen" class="btn-primary btn-link pull-right" style="position: absolute; margin-top: -47px; margin-bottom: 0px; right: 30px; padding: 5px; z-index: 1; border-radius: 5px; box-shadow: 0 1px 2px black !important;"><i id="profile-maps-xx" class="glyphicon glyphicon-fullscreen fa-lg" title="<?php echo $lang_profile['maps-full-screen']; ?>"></i></button></header>
                <div id="atcpanel-maps-x" class="col-xs-12 col-sm-3 col-md-3 col-lg-3"></div>
            </div>
            <!-- <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1"></div> -->
            <!-- <form action="<?php echo base_url('takip/profile'); ?>" method="post" enctype="multipart/form-data">-->
            <?php echo form_open_multipart('takip/profile');?>
            
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <section id="profile">
                    <header><h2 class="left-h2" style="border-bottom: 1px #000 solid; padding-bottom: 10px;"><?php echo $this->session->userdata('username'); ?> </h2></header>
                    <div class="container-fluid">
                        <div class="row">
                            <section id="contact">
                                <h3><?php echo $lang_profile['user-information']; ?></h3>
                                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                    <h4 class="fa-green"><em><?php echo $lang_profile['profile-picture']; ?></em></h4>
                                    <div class="upload_avatar_preview"></div>
                                    <input type="file" name="userfile[]" multiple="multiple"  class="files" style="margin-top: 15px; margin-bottom: 10px;">
                                    <!-- <img id="denemeresim" src="<?php echo base_url('assets/img/login/resim22.jpg'); ?>" alt="<?php echo $this->session->userdata('username'); ?>" class="img-thumbnail img-responsive">-->
                                    <!--<button type="file" class="btn btn-primary btn-lg col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 15px; margin-bottom: 10px;">Avatar Yükle</button>-->
                                </div>
                                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                    <?php if ($this->session->userdata('userstatus') < 4) { ?>
                                    <h4 class="fa-green"><em>Lisans İşlemleri</em></h4>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <p style="border: 1px #000 dashed; border-radius: 3px; padding: 3px 5px 3px 5px; margin-bottom: 20px;"><mark>Araç Takip Paneli Lisans ücretleri 1 - 500 Cihaz <em><i class="fa fa-usd fa-green fa-lg"></i> 0.45 /ay</em> | 1000 - 10000 Cihaz <em><i class="fa fa-usd fa-green fa-lg"></i> 0.99 / ay</em> || Sınırsız Cihaz için Lütfen Fiyat İsteyiniz.</mark></p>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="userlisans">Lisansınızı Güncelleyin   <mark style="font-size: 0.9em;"><small><em>Seçtiğiniz Lisans Ödemeniz Onaylandığı Andan itibaren Geçerli Olacaktır.</em></small></mark></label>
                                            <select class="form-control">
                                                <option>Lisans Seçin</option>
                                                <option>Ücretsiz Demo Paket (3 Cihaz) 1 Haftalık</option>
                                                <option>2 Yıllık Eko Paket (10 Cihaz)</option>
                                                <option>2 Yıllık Plus Paket (50 Cihaz)</option>
                                                <option>2 Yıllık Ultra Paket (100 Cihaz)</option>
                                                <option>2 Yıllık Enterprise Paket (150 Cihaz)</option>
                                                <option>2 Yıllık Mega Paket (2000 Cihaz)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="userlisanscount">Lisans Miktarı</label>
                                            <input type="number" class="form-control" id="userlisanscount" placeholder="Lisans Miktari">
                                        </div>
                                        <h2  style="border-bottom: 2px #000 dotted;"></h2>
                                    </div>
                                    <?php } ?>
                                    <h4 class="fa-green"><em><?php echo $lang_profile['user-information']; ?></em></h4>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="username"><?php echo $lang_profile['username']; ?>    <mark style="font-size: 0.9em;"><small><em><?php echo $lang_profile['username-small']; ?></em></small></mark></label>
                                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $this->session->userdata('username'); ?>" disabled placeholder="<?php echo $lang_profile['username']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="fristname"><?php echo $lang_profile['your-name']; ?></label>
                                            <input type="text" class="form-control" id="fristname" name="fristname" value="<?php echo $veri[0]; ?>" placeholder="<?php echo $lang_profile['your-name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="lastname"><?php echo $lang_profile['your-last-name']; ?></label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $veri[1]; ?>" placeholder="<?php echo $lang_profile['your-last-name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="emailaddress"><?php echo $lang_profile['your-e-mail']; ?>   <mark style="font-size: 0.9em;"><small><em><?php echo $lang_profile['your-e-mail-small']; ?></em></small></mark></label>
                                            <input type="email" class="form-control" id="emailaddress" name="emailaddress" value="<?php echo $this->session->userdata('useremail'); ?>" disabled placeholder="<?php echo $lang_profile['your-e-mail']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="phonenumber"><?php echo $lang_profile['your-phone-numberf']; ?></label>
                                            <input type="tel" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo $veri[2]; ?>" placeholder="<?php echo $lang_profile['your-phone-numberf']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="gsmnumber"><?php echo $lang_profile['your-phone-numberm']; ?></label>
                                            <input type="tel" class="form-control" id="gsmnumber" name="gsmnumber" value="<?php echo $veri[3]; ?>" placeholder="<?php echo $lang_profile['your-phone-numberm']; ?>">
                                        </div>
                                    </div>
                                    <!-- koordinat verilerinin alındığı satır -->
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h2 style="border-bottom: 1px #000 dashed; margin-bottom: 15px;"></h2>
                                    </div>
                                    <h4 class="fa-green"><em><?php echo $lang_profile['coordinate-information']; ?></em></h4>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="latitude"><?php echo $lang_profile['my-profile-latitude']; ?>  </label>
                                            <input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo $veri[4]; ?>" placeholder="latitude">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="longitude"><?php echo $lang_profile['my-profile-longitude']; ?>  </label>
                                            <input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo $veri[5]; ?>" placeholder="longitude">
                                        </div>
                                    </div>
                                    <!-- #################################### -->
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h2 style="border-bottom: 1px #000 dashed; margin-bottom: 15px;"></h2>
                                    </div>
                                    <h4 class="fa-green"><em><?php echo $lang_profile['short-note-panel']; ?></em></h4>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="shortmessage"><?php echo $lang_profile['short-notes']; ?></label>
                                            <textarea class="form-control col-xs-12 col-sm-12 col-md-12 col-lg-12" id="shortmessage" name="shortmessage" rows="5"><?php echo $veri[6]; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 15px; margin-bottom: 15px;">
                                        <div class="form-group clearfix">
                                                <button type="submit" class="btn pull-right btn-primary btn-lg"><?php echo $lang_profile['save-changes-button']; ?></button>
                                            </div><!-- /.form-group -->
                                    </div>
                                </div>
                            </section> 
                        </div>
                    </div>
                </section>
             </div>
            </form>
        </div>
    </div>
</div>