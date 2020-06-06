<div class="toolbar">
	<a <?php echo $classActive = ($com == 'thong-tin-ca-nhan') ? 'class="active"' : '' ?> href="thong-tin-ca-nhan"><i class="fa fa-user" aria-hidden="true"></i> Thông tin cá nhân</a>
	<a <?php echo $classActive = ($com == 'doi-mat-khau') ? 'class="active"' : '' ?> href="doi-mat-khau"><i class="fa fa-lock" aria-hidden="true"></i> Đổi mật khẩu</a>
	<a <?php echo $classActive = ($com == 'kiem-tra-don-hang') ? 'class="active"' : '' ?> href="kiem-tra-don-hang"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Kiểm tra đơn hàng</a>
	<a <?php echo $classActive = ($com == '') ? 'class="active"' : '' ?> href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a>
</div>