<div class="wrapper">
	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li class="current"><a href="index.php?com=onesignal">Đẩy tin - Onesignal</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<form name="supplier" class="form" action="index.php?com=onesignal&act=save" method="post" enctype="multipart/form-data">
		<div class="widget">			
			<div class="formRow">
				<label>Tải hình ảnh:</label>
				<div class="formRight">
					<input type="file" id="file" name="file" />
					<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
					<div class="note"> width : 512 px , Height : 512 px </div>

				</div>
				<div class="clear"></div>
			</div>			
			<?php if (isset($_GET['id'])): ?>
				<div class="formRow">
					<label> Ảnh:</label>
					<div class="formRight">	
						<img style="width: 512px;height: 512px" src="../thumb/512x512/2/<?=_upload_hinhanh_l.$item['photo']?>" alt="" onError="this.src='images/no_image.jpg';" style="border:1px solid #CCC;" />
					</div>
					<div class="clear"></div>
				</div>
			<?php endif ?>	
			<div class="formRow lang_hidden lang_vi active">
				<label>Tiêu đề</label>
				<div class="formRight">
					<input type="text" name="heading" class="form-control" value="<?php echo $item['ten'] ?>" />
				</div>
				<div class="clear"></div>
			</div>			
			<div class="formRow lang_hidden lang_vi active">
				<label>Mô tả</label>
				<div class="formRight">
					<textarea name="content" cols="50" rows="4" id="mota_vi" class="form-control"><?php echo $item['noidung'] ?></textarea> 
				</div>
				<div class="clear"></div>
			</div>
			<div class="formRow lang_hidden lang_vi active">
				<label>Đường dẫn</label>
				<div class="formRight">
					<input type="text" name="url" class="form-control" value="<?php echo $item['link'] ?>"  />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow lang_hidden lang_vi active">
				<label>Thời gian bắt đầu</label>
				<div class="formRight">
					<input type="text" name="thoi_gian" id="datepicker" class="form-control"/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow lang_hidden lang_vi active">
				<label>Số lần</label>
				<div class="formRight">
					<input type="text" name="solan" class="form-control conso"/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow lang_hidden lang_vi active">
				<label>Khoảng thời gian <br> giữa các lần (phút) </label>
				<div class="formRight">
					<input type="text" name="step" class="form-control conso"/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<div class="formRight">
					<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
				</div>
				<div class="clear"></div>
			</div>
		</div>  
		<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	</form>    
</div>

<script>
	$(function(){
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'dd-mm-yy',
			minDate: new Date(),
		});
	})
</script>