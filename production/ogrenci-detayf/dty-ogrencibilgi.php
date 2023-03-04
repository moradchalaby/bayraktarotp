<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                    <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">



                        <div class="form-group">
                            <?php if (strlen($ogrencicek['ogrenci_kmlk']) > 0) : ?>
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name"><a href="../<?php echo $ogrencicek['ogrenci_kmlk']; ?> " target="_blank">Kimlik Fotokopisi</a><span class="required">*</span></label>
                            <?php endif ?>

                            <?php if (strlen($ogrencicek['ogrenci_sglk']) > 0) : ?>
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name"><a href="../<?php echo $ogrencicek['ogrenci_sglk']; ?> " target="_blank">Sağlık Raporu</a></label>
                            <?php endif ?>
                            <?php if (strlen($ogrencicek['ogrenci_belge1']) > 0) : ?>
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name"><a href="../<?php echo $ogrencicek['ogrenci_belge1']; ?> " target="_blank">Belge-1</a></label>
                            <?php endif ?>
                            <?php if (strlen($ogrencicek['ogrenci_belge2']) > 0) : ?>
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name"><a href="../<?php echo $ogrencicek['ogrenci_belge2']; ?> " target="_blank">Belge-2</a></label>
                            <?php endif ?>
                            <?php if (strlen($ogrencicek['ogrenci_belge3']) > 0) : ?>
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name"><a href="../<?php echo $ogrencicek['ogrenci_belge3']; ?> " target="_blank">Belge-3</a></label>
                            <?php endif ?>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TC No<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="ogrenci_tc" value="<?php echo $ogrencicek['ogrenci_tc'] ?>" placeholder="TC No" maxlength="11" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>

                        <?php if ($kullanicicek['kullanici_yetki'] >= 4) : ?>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea type="text" id="first-name" name="ogrenci_adres" class="form-control col-md-7 col-xs-12" placeholder="Adres" readonly><?php echo $ogrencicek['ogrenci_adres'] ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Baba Adı<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" value="<?php echo $ogrencicek['ogrenci_baba'] ?>" name="ogrenci_baba" placeholder="Baba Adı" class="form-control col-md-7 col-xs-12" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Baba Tel<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" value="<?php echo $ogrencicek['ogrenci_babatel'] ?>" name="ogrenci_babatel" placeholder="Baba Telefon No" class="form-control col-md-7 col-xs-12" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Baba Meslek<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" value="<?php echo $ogrencicek['ogrenci_babames'] ?>" name="ogrenci_babames" placeholder="Baba Mesleği" class="form-control col-md-7 col-xs-12" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Anne Adı<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" value="<?php echo $ogrencicek['ogrenci_anne'] ?>" name="ogrenci_anne" placeholder="Anne Adı" class="form-control col-md-7 col-xs-12" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Anne Tel<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" value="<?php echo $ogrencicek['ogrenci_annetel'] ?>" name="ogrenci_annetel" placeholder="Anne Telefon No" class="form-control col-md-7 col-xs-12" readonly>
                                </div>
                            </div>
                        <?php endif ?>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Okul Durumu<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" value="<?php echo $ogrencicek['ogrenci_okuldurum'] ?>" name="ogrenci_okuldurum" placeholder="Okul Durumu" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>






                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Durum<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" value="<?php echo $ogrencicek['ogrenci_kytdrm'] == '1' ? ' Aktif' : 'Pasif'; ?>" name="ogrenci_kytdrm" placeholder="Kayıt Durumu" class="form-control col-md-7 col-xs-12" readonly>


                            </div>
                        </div>




                        <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id'] ?>">

                        <div class="ln_solid"></div>


                    </form>
                </div>