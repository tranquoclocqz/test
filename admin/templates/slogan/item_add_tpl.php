<div class="control_frm" style="margin-top:25px;">
	<div class="bc">
		<ul id="breadcrumbs" class="breadcrumbs">
			<li><a href="index.php?com=slogan&act=capnhat"><span>Slogan</span></a></li>
			<li class="current"><a href="#" onclick="return false;">Slogan website</a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=slogan&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">

		<div class="formRow lang_hidden lang_vi active">
			<label>Tiêu đề hỗ trợ</label>
			<div class="formRight">
				<input type="text" name="ten_sp_vi" title="Nhập slogan" id="ten_sp_vi" class="tipS " value="<?=@$item['ten_sp_vi']?>" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow lang_hidden lang_vi active">
			<label>Slogan hỗ trợ</label>
			<div class="formRight">
				<input type="text" name="ten_sp_en" title="Nhập slogan" id="ten_sp_en" class="tipS " value="<?=@$item['ten_sp_en']?>" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow lang_hidden lang_vi active">
			<label>Tiêu đề cho thuê xe</label>
			<div class="formRight">
				<input type="text" name="ten_gt_vi" title="Nhập slogan" id="ten_gt_vi" class="tipS " value="<?=@$item['ten_gt_vi']?>" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow lang_hidden lang_vi active">
			<label>Slogan cho thuê xe</label>
			<div class="formRight">
				<input type="text" name="ten_gt_en" title="Nhập slogan" id="ten_gt_en" class="tipS " value="<?=@$item['ten_gt_en']?>" />
			</div>
			<div class="clear"></div>
		</div>
		

		<div class="formRow lang_hidden lang_vi active">
			<label>Tiêu đề đối tác</label>
			<div class="formRight">
				<input type="text" name="ten_album_vi" title="Nhập slogan" id="ten_album_vi" class="tipS " value="<?=@$item['ten_album_vi']?>" />
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow lang_hidden lang_vi active">
			<label>Slogan đối tác</label>
			<div class="formRight">
				<input type="text" name="ten_album_en" title="Nhập slogan" id="ten_album_en" class="tipS " value="<?=@$item['ten_album_en']?>" />
			</div>
			<div class="clear"></div>
		</div>
		
		
		<div class="formRow">
			<div class="formRight">
				<input type="hidden" name="id" id="id_this_setting" value="<?=@$item['id']?>" />
				<input type="submit" class="blueB"  value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>   