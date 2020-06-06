<section class="section-main">
  <div class="container">
    <?php echo $breadcrumb ?>
    <div class="grid">
      <div class="col-flex-md-6">
        <article class="noidung clearfix">
          <?= $row_detail['noidung'] ?>
        </article>
        <div class="iframe_wrapper">
          <iframe data-src="<?php echo match_iframe_src($row_setting['toado']) ?>" frameborder="0"></iframe>
        </div>
      </div>
      <div class="col-flex-md-6">
        <form action="" id="form-lienhe" method="post">
          <div class="grid">
            <div class="col-flex-12 col-contact">
              <div class="group-addon">
                <input class="input-lienhe" name="txt_ten" placeholder="<?= _ten ?>" required="required" type="text" id="txt_ten" />
              </div>
            </div>
            <div class="col-flex-12 col-contact">
              <div class="group-addon">
                <input class="input-lienhe" name="txt_dienthoai" pattern="\d*" type="text" placeholder="<?= _dienthoai ?>" required="required" id="txt_dienthoai" />
              </div>
            </div>
            <div class="col-flex-12 col-contact">
              <div class="group-addon">
                <input class="input-lienhe" name="txt_email" type="email" placeholder="Email " required="required" id="email" />
              </div>
            </div>
            <div class="col-flex-12 col-contact">
              <div class="group-addon">
                <input class="input-lienhe" name="txt_diachi" type="text" placeholder="<?php echo _diachi ?>" id="diachi" />
              </div>
            </div>
            <div class="col-flex-12 col-contact">
              <div class="group-addon">
                <textarea class="input-lienhe" name="txt_noidung" cols="50" rows="5" id="txt_noidung" placeholder="<?= _tinnhan ?> " required="required" style=""></textarea>
              </div>
            </div>
            <div class="col-flex-12 mr-top">
              <div class="text-center">
                <?php if ($config['google_recaptcha_v3']) : ?> <input type="hidden" name="recaptcha_response" id="recaptchaResponse"> <?php endif ?>
                <button class="btns" name="btn-send" type="submit"><?= _submit_contact ?></button>
              </div>
            </div>
          </div>
        </form>
      </div>      
    </div>
  </div>
</section>