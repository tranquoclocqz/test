
<script type="text/javascript">		
	$(document).ready(function() {
		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_'+lang).addClass('active');
			return false;
		});
	});

</script>
<div class="wrapper">

	<div class="control_frm" style="margin-top:25px;">
		<div class="bc">
			<ul id="breadcrumbs" class="breadcrumbs">
				<li><a href="index.php?com=video&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Thêm <?=$title_main?></span></a></li>
				<li class="current"><a href="#" onclick="return false;">Thêm</a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>

	<form name="supplier" id="validate" class="form" action="index.php?com=video&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
		<div class="widget">
			<?php if ($config_video_internal) { ?>
				<div class="formRow">
					<label>Chọn video:</label>
					<div class="formRight">
						<div class="input-group">
							<input type="text" placeholder="Video" id="video" name="links" value="<?php echo $item['links'] ?>">
							<span class="input-group-btn" id="basic-addon2"><button type="button" class="btn btn-primary browser" data-for="video" style="max-height: initial;">Browse Server</button></span>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<label>Tiêu đề</label>
					<div class="formRight">
						<input type="text" name="ten_vi" title="Nhập tên danh mục <?php echo $value['ten'] ?>" id="ten_vi" class="tipS validate[required]" value="<?=@$item['ten_vi']?>" />
					</div>
					<div class="clear"></div>
				</div>		

			<?php } else { ?>
				<?php if($_GET['act']=='edit'){?>
					<div class="formRow">
						<label>Video Hiện Tại :</label>
						<div class="formRight">
							<object width="580" height="435"><param name="movie" value="//www.youtube.com/v/<?=getIDyoutube($item['links'])?>?version=3&amp;hl=vi_VN&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="//www.youtube.com/v/<?=getIDyoutube($item['links'])?>?version=3&amp;hl=vi_VN&amp;rel=0" type="application/x-shockwave-flash" width="300" height="200" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" ></embed></object>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
				<?php
				if($config_images){
					?>
					<div class="formRow">
						<label>Ảnh đại diện :</label>
						<div class="formRight">
							<input type="file" id="file" name="file" />
							<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
							<div class="note"> width : <?php echo _width_thumb*$ratio_;?> px , Height : <?php echo _height_thumb*$ratio_;?> px </div>
						</div>
						<div class="clear"></div>
					</div>
					<?php if(!empty($item['photo'])){?>
						<div class="formRow">
							<label>Hình Hiện Tại :</label>
							<div class="formRight">

								<div class="mt10"><img class="max-widht" src="../thumb/<?php echo _width_thumb.'x'._height_thumb.'/'._style_thumb.'/'._upload_hinhanh_l.$item['photo']?>"  alt="NO PHOTO" /></div>

							</div>
							<div class="clear"></div>
						</div>
					<?php } 
				}?>
				<div class="formRow">
					<label>Tiêu đề</label>
					<div class="formRight">
						<input type="text" name="ten_vi" title="Nhập tên danh mục <?php echo $value['ten'] ?>" id="ten_vi" class="tipS validate[required]" value="<?=@$item['ten_vi']?>" />
					</div>
					<div class="clear"></div>
				</div>


				<div class="formRow">
					<label>Links ( Youtube )</label>
					<div class="formRight">
						<input type="text" name="links" title="Nhập tên links youtube" id="ten_en" class="tipS validate[required]" value="<?=@$item['links']?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>

			<div class="formRow">
				<label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
				<div class="formRight">
					
					<input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
					<label>Số thứ tự: </label>
					<input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
				</div>
				<div class="clear"></div>
			</div>
			
		</div>  
		<div class="widget">
			<div class="formRow">
				<div class="formRight">
					<input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
					<input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
					<input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
					<a href="index.php?com=video&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
				</div>
				<div class="clear"></div>
			</div>

		</div>
	</form>        </div>
