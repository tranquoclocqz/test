<script type="text/javascript">

	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
	function update(id){
		if(id>0){
			var sl=$('#product'+id).val();
			if(sl>0){
				$('#ajaxloader'+id).css('display', 'block');	
				jQuery.ajax({
					type: 'POST',
					url: "ajax.php?do=cart&act=update",
					data: {'id':id, 'sl':sl},				
					success: function(data) {					
						$('#ajaxloader'+id).css('display', 'none');	
						var getData = $.parseJSON(data);
						$('#id_price'+id).html(addCommas(getData.thanhtien)+'&nbsp;đ');
						$('#sum_price').html(addCommas(getData.tongtien)+'&nbsp;đ');
					}
				});			
			}else alert('Số lượng phải lớn hơn 0');
		}
	}

	function del(id){
		if(id>0){				
			jQuery.ajax({
				type: 'POST',
				url: "ajax.php?do=cart&act=delete",
				data: {'id':id},			
				success: function(data) {										
					var getData = $.parseJSON(data);
					$('#productct'+id).css('display', 'none');	
					$('#sum_price').html(addCommas(getData.tongtien)+'&nbsp;đ');
				}
			});
		}
	}
</script>  
<div class="control_frm" style="margin-top:25px;">
	<div class="bc">
		<ul id="breadcrumbs" class="breadcrumbs">
			<li><a href="index.php?com=order&act=mam"><span>Đơn hàng</span></a></li>
			<li class="current"><a href="#" onclick="return false;">Xem và sửa đơn hàng</a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<form name="supplier" id="validate" class="form" action="index.php?com=order&act=save" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thông tin người mua</h6>
		</div>

		<div class="formRow">
			<label>Mã đơn hàng</label>
			<div class="formRight">
				<?=@$item['madonhang']?>
			</div>
			<div class="clear"></div>
		</div>	

		<div class="formRow">
			<label>Họ tên</label>
			<div class="formRight">
				<?=@$item['hoten']?>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>Điện thoại</label>
			<div class="formRight">
				<?=@$item['dienthoai']?>
			</div>
			<div class="clear"></div>
		</div>		        
		<div class="formRow">
			<label>Email</label>
			<div class="formRight">
				<?=@$item['email']?>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>Tỉnh/ Thành</label>
			<div class="formRight">
				<?=@get_tinh($item['tinhthanh'])?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Quận/ Huyện</label>
			<div class="formRight">
				<?=@get_huyen($item['quanhuyen'])?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="formRow">
			<label>Địa chỉ</label>
			<div class="formRight">
				<?=@$item['diachi']?>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="formRow">
			<label>Thanh toán</label>
			<div class="formRight">
				<?=@phuong_thuc_thanh_toan($item['hinhthuc'])?>
			</div>
			<div class="clear"></div>
		</div>	
		
		<div class="formRow">
			<label>Yêu cầu thêm</label>
			<div class="formRight">
				<?=@$item['noidung']?>
			</div>
			<div class="clear"></div>
		</div>
		<?php if( !empty($item['ten_congty']) ) { ?>
			<div class="formRow">
				<label>Tên công ty</label>
				<div class="formRight">
					<?=@$item['ten_congty']?>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>
		<?php if( !empty($item['diachi_congty']) ) { ?>
			<div class="formRow">
				<label>Địa chỉ công ty</label>
				<div class="formRight">
					<?=@$item['diachi_congty']?>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>
		<?php if( !empty($item['masothue']) ) { ?>
			<div class="formRow">
				<label>Mã số thuế</label>
				<div class="formRight">
					<?=@$item['masothue']?>
				</div>
				<div class="clear"></div>
			</div>
		<?php } ?>

	</div>
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Chi tiết đơn hàng</h6>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
			<thead>
				<tr>
					<td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">STT</a></td>      
					<td class="sortCol"><div>Tên sản phẩm<span></span></div></td>
					<td width="150">Hình ảnh</td>
					<td width="150">Đơn giá</td>
					<td width="150">Số lượng</td>
					<td width="150">Thành tiền</td>
					<?php if ($config_member): ?>
						<td width="150">Thành viên</td>
					<?php endif ?>
				</tr>
			</thead> 
			<tfoot>
				<tr>
					<td colspan="<?php if ($config_member): ?>5<?php else: ?>4<?php endif ?>"><div class="pagination">Tổng tiền</div></td>

					<td align="center"><div class="pagination" id="sum_price"> <?=number_format(get_tong_tien($item['id']),0, ',', '.')?>&nbsp;đ</div></td>
					<td></td>
				</tr>
			</tfoot>   
			<tbody>
				<?php      
				$tongtien=0;          
				for($i=0,$count_donhang=count($result_ctdonhang);$i<$count_donhang;$i++){	
					$pid=$result_ctdonhang[$i]['id_product'];
					$pname=get_product_name($pid);
					$pphoto=get_thumb($pid);
					$tongtien+=	$result_ctdonhang[$i]['gia']*$result_ctdonhang[$i]['soluong'];	
					?>
					<tr id="productct<?=$result_ctdonhang[$i]['id']?>">
						<td><?=$i+1?></td>
						<td>
							<p><?=$pname?></p>
						<?php if ($result_ctdonhang[$i]['size'] != ' - '): ?>
							<p>Size: <?php echo $result_ctdonhang[$i]['size'] ?></p>
						<?php endif ?>
						<?php if ($result_ctdonhang[$i]['mausac'] != ''): ?>
							<p>Màu sắc: <?php echo $result_ctdonhang[$i]['mausac'] ?></p>
						<?php endif ?>
					</td>
					<td align="center"><img src="<?=_upload_product.$pphoto?>" height="100"  /></td>
					<td align="center"><?=number_format($result_ctdonhang[$i]['gia'],0, ',', '.')?>&nbsp;đ</td>
					<td align="center"><input readonly type="text" class="tipS" style="width:50px; text-align:center" original-title="Nhập số lượng sản phẩm" maxlength="3" value="<?=$result_ctdonhang[$i]['soluong']?>" onchange="update(<?=$result_ctdonhang[$i]['id']?>)" id="product<?=$result_ctdonhang[$i]['id']?>">
						<div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$result_ctdonhang[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
						&nbsp;
					</td>
					<td align="center" id="id_price<?=$result_ctdonhang[$i]['id']?>">
						<?=number_format(($result_ctdonhang[$i]['gia'] * $result_ctdonhang[$i]['soluong']),0, ',', '.')?>&nbsp;đ
					</td>
					<?php if ($config_member): ?>
						<td align="center">
							<?php if ($item['mathanhvien'] != ''): ?>
								<a href="index.php?com=member&act=edit&id=<?php echo $item['mathanhvien'] ?>" title="<?php echo ten_thanhvien($item['mathanhvien']) ?>"><?php echo ten_thanhvien($item['mathanhvien']) ?></a>
								<?php else: ?>
									Không
								<?php endif; ?>

							</td>	
						<?php endif; ?>							
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Thông tin thêm</h6>
		</div>

		<div class="formRow">
			<label>Nội Dung :</label>
			<div class="formRight">
				<textarea rows="8" cols="" title="Viết ghi chú cho đơn hàng" class="tipS" name="ghichu" id="ghichu"><?=@$item['ghichu']?></textarea>
			</div>
			<div class="clear"></div>
		</div>	



		<div class="formRow">
			<div class="formRight">	     
				<input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
				<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Cập nhật" />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>  