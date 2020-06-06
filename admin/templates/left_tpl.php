<div class="logo"> <a href="#" target="_blank" onclick="return false;"> <img src="images/logo.png" alt="" /> </a></div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav">
  <li class="dash" id="menu1"><a class="active" title="" href="index.php"><span>Trang chủ</span></a></li>
  <li class="categories_li <?php if ($_GET['com'] == 'baiviet') echo ' activemenu' ?>" id="menu_baiviet"><a href="" title="" class="exp"><span>Bài viết</span><strong></strong></a>
    <ul class="sub">
      <li <?php if ($_GET['type'] == 'khung-gia-dat') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=khung-gia-dat">Khung giá đất</a></li>
      <li <?php if ($_GET['type'] == 'tu-van-thiet-ke') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=tu-van-thiet-ke">Tư vấn thiết kế</a></li>
      <li <?php if ($_GET['type'] == 'ky-gui') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=ky-gui">Ký gửi</a></li>
      <li <?php if ($_GET['type'] == 'tin-tuc') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=tin-tuc">Tin tức</a></li>
      <li <?php if ($_GET['type'] == 'dich-vu') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=dich-vu">Dịch vụ</a></li>
      <li <?php if ($_GET['type'] == 'y-kien-khach-hang') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=y-kien-khach-hang">Ý kiến khách hàng</a></li>
    </ul>
  </li>
  <li class="categories_li <?php if ($_GET['com'] == 'product') echo ' activemenu' ?>" id="menu_bat-dong-san"><a href="" title="" class="exp"><span>Bất động sản</span><strong></strong></a>
    <ul class="sub">
       <li<?php if ($_GET['type'] == 'bat-dong-san' && preg_match('/_list/', $_GET['act'])) echo ' class="this"' ?>><a href="index.php?com=product&act=man_list&type=bat-dong-san">Danh mục cấp 1</a></li>
      <li<?php if ($_GET['type'] == 'bat-dong-san' && preg_match('/_cat/', $_GET['act'])) echo ' class="this"' ?>><a href="index.php?com=product&act=man_cat&type=bat-dong-san">Danh mục cấp 2</a></li>
      <li<?php if ($_GET['type'] == 'bat-dong-san' && in_array($_GET['act'] , array('add','edit','man'))) echo ' class="this"' ?>><a href="index.php?com=product&act=man&type=bat-dong-san">Bất động sản</a></li>
    </ul>
  </li>
  <li class="template_li<?php if ($_GET['com'] == 'info' ) echo ' activemenu' ?>" id="menu_info"><a href="#" title="" class="exp"><span>Trang</span><strong></strong></a>
    <ul class="sub">
      <li <?php if ($_GET['com'] == 'info') echo ' class="this"' ?>><a href="index.php?com=info&act=capnhat&type=gioi-thieu" title="">Giới thiệu</a></li>
    </ul>
  </li>

  <li class="template_li<?php if ($_GET['com'] == 'setting' || $_GET['com'] == 'company' || $_GET['com'] == 'newsletter' || $_GET['com'] == 'yahoo') echo ' activemenu' ?>" id="menu5"><a href="#" title="" class="exp"><span>Thông tin công ty</span><strong></strong></a>
    <ul class="sub">
      <li <?php if ($_GET['com'] == 'setting') echo ' class="this"' ?>><a href="index.php?com=setting&act=capnhat" title="">Cấu hình chung</a></li>
      <li <?php if ($_GET['com'] == 'company' && $_GET['type'] == 'lien-he') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=lien-he" title="">Liên hệ</a></li>
      <li <?php if ($_GET['com'] == 'company' && $_GET['type'] == 'footer') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=footer" title="">Footer</a></li>
      <li <?php if ($_GET['com'] == 'yahoo') echo ' class="this"' ?>><a href="index.php?com=yahoo&act=man&type=ho-tro" title="">Danh sách hỗ trợ</a></li>
    </ul>
  </li>

  <li class="template_li<?php if ($_GET['com'] == 'tieude' ) echo ' activemenu' ?>" id="menu_tieude"><a href="#" title="" class="exp"><span>SEO PAGE</span><strong></strong></a>
    <ul class="sub">
      <li <?php if ($_GET['com'] == 'tieude') echo ' class="this"' ?>><a href="index.php?com=tieude&act=man" title="">SEO PAGE</a></li>
    </ul>
  </li>
  <li class="template_li<?php if ($_GET['com'] == 'bannerqc') echo ' activemenu' ?>" id="menu_banner_logo"><a href="#" title="" class="exp"><span>Logo-Banner-Favicon</span><strong></strong></a>
    <ul class="sub">
      <li <?php if ($_GET['type'] == 'logo') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=logo" title="">Logo</a></li>
      <li <?php if ($_GET['type'] == 'banner') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=banner" title="">Banner</a></li>
      <li <?php if ($_GET['type'] == 'favicon') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=favicon" title="">Favicon</a></li>
    </ul>
  </li>
  <li class="gallery_li<?php if ($_GET['com'] == 'photo') echo ' activemenu' ?>" id="menu7"><a href="#" title="" class="exp"><span>Hình Ảnh</span><strong></strong></a>
    <ul class="sub">
      <li <?php if ($_GET['type'] == 'slider') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=slider" title="">Slider</a></li>
      <li <?php if ($_GET['type'] == 'bannerqc') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=bannerqc" title="">Banner trái</a></li>
      <li <?php if ($_GET['type'] == 'bannerqc2') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=bannerqc2" title="">Banner phải</a></li>
    </ul>
  </li>


  <li class="gallery_li<?php if ($_GET['com'] == 'lkweb') echo ' activemenu' ?>" id="menu_lkweb"><a href="#" title="" class="exp"><span>Liên kết web</span><strong></strong></a>
    <ul class="sub">
      <li <?php if ($_GET['type'] == 'link-san-pham') echo ' class="this"' ?>><a href="index.php?com=lkweb&act=man&type=link-san-pham" title="">Liên sản phẩm</a></li>
      <li <?php if ($_GET['type'] == 'socialtop') echo ' class="this"' ?>><a href="index.php?com=lkweb&act=man&type=socialtop" title="">Liên kết web 1</a></li>
      <li <?php if ($_GET['type'] == 'socialfooter') echo ' class="this"' ?>><a href="index.php?com=lkweb&act=man&type=socialfooter" title="">Liên kết web 2</a></li>
    </ul>
  </li>


  <li class="gallery_li<?php if ($_GET['com'] == 'background') echo ' activemenu' ?>" id="background"><a href="#" title="" class="exp"><span>Background</span><strong></strong></a>
    <ul class="sub">
      <li <?php if ($_GET['type'] == 'bgweb') echo ' class="this"' ?>><a href="index.php?com=background&act=capnhat&type=bgweb" title="">Background footer</a></li>
      <li <?php if ($_GET['type'] == 'bgweb1') echo ' class="this"' ?>><a href="index.php?com=background&act=capnhat&type=bgweb1" title="">Background tin tức</a></li>
      <li <?php if ($_GET['type'] == 'bgweb2') echo ' class="this"' ?>><a href="index.php?com=background&act=capnhat&type=bgweb2" title="">Background head</a></li>
    </ul>
  </li>

</ul>
