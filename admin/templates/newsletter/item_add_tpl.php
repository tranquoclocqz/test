<form name="frm" method="post" class="form-inline"  action="index.php?com=newsletter&act=send&type=<?php echo $_GET['type'] ?>" enctype="multipart/form-data" id="f">	
	<input type="hidden" name="listid" id="listid" value="<?php echo $item['id'] ?>">
	<div class="widget" style="width: 100%;">
		<?php if( !empty($item['ten']) ) { ?>
			<div class="formRow">
				<div class="form-group" style="width: 100%">
					<div class="row">
						<div class="col-sm-2">
							<strong> Tên: </strong>
						</div>
						<div class="col-sm-10">
							<?php echo $item['ten'] ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if( !empty($item['dienthoai']) ) { ?>
			<div class="formRow">
				<div class="form-group" style="width: 100%">
					<div class="row">
						<div class="col-sm-2">
							<strong> Điện thoại: </strong>
						</div>
						<div class="col-sm-10">
							<?php echo $item['dienthoai'] ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if( !empty($item['email']) ) { ?>
			<div class="formRow">
				<div class="form-group" style="width: 100%">
					<div class="row">
						<div class="col-sm-2">
							<strong> Email: </strong>
						</div>
						<div class="col-sm-10">
							<?php echo $item['email'] ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if( !empty($item['tieude']) ) { ?>
			<div class="formRow">
				<div class="form-group" style="width: 100%">
					<div class="row">
						<div class="col-sm-2">
							<strong> Tiêu đề: </strong>
						</div>
						<div class="col-sm-10">
							<?php echo $item['tieude'] ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if( !empty($item['diachi']) ) { ?>
			<div class="formRow">
				<div class="form-group" style="width: 100%">
					<div class="row">
						<div class="col-sm-2">
							<strong> Địa chỉ: </strong>
						</div>
						<div class="col-sm-10">
							<?php echo $item['diachi'] ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if( !empty($item['noidung']) ) { ?>
			<div class="formRow">
				<div class="form-group" style="width: 100%">
					<div class="row">
						<div class="col-sm-2">
							<strong> Nội dung: </strong>
						</div>
						<div class="col-sm-10">
							<?php echo $item['noidung'] ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>  
</form> 