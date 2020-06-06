<?php
$row_lienhe = _fetch_array("SELECT COUNT(id) as num FROM table_contact where view=0 AND type='lien-he'");
?>
<div class="wrapper">
  <div class="welcome"><a href="#" title=""><img src="images/userPic.png" alt="" /></a><span>Xin chào, <?=$_SESSION['login']['username']?>!</span></div>
  <div class="userNav">
    <ul>

      <li><a href="http://<?=$config_url?>" title="" target="_blank"><img src="./images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
      <li><a href="index.php?com=user&act=admin_edit" title=""><img src="images/icons/topnav/profile.png" alt="" /><span>Thông tin tài khoản</span></a></li>
    </li>
    <li class="ddnew"><a href="index.php?com=contact&act=man&type=lien-he" title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Liên hệ</span><span class="numberTop"><?=$row_lienhe['num']?></span></a> </li>
    <li><a href="index.php?com=user&act=logout" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Đăng xuất</span></a></li>
  </ul>
</div>
<div class="clear"></div>
</div>
