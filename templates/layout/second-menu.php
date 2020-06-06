<div class="second-menu">
	<ul>
		<?php foreach($danh_muc_san_pham as $key => $value) {
			$ar_menu = array();
			$cap2 = _result_array("SELECT ten_$lang as ten,id,tenkhongdau from table_product_cat where type like 'san-pham' and hienthi = 1 and id_list = '".$value['id']."' order by stt asc,id desc ");				
			foreach( $cap2 as $key2 => $value2 ){ 
				$ar_menu[] = '<h2 class="menu-item-2"><a href="'.$value2['tenkhongdau'].'">'.$value2['ten'].'</a></h2>';
				$cap3 = _result_array("SELECT ten_$lang as ten,id,tenkhongdau from table_product_item where type like 'san-pham' and hienthi = 1 and id_cat = '".$value2['id']."' order by stt asc,id desc ");
				foreach ($cap3 as $key3 => $value3) {
					$ar_menu[] = '<span class="menu-item-3"><a href="'.$value3['tenkhongdau'].'">'.$value3['ten'].'</a></span>';
				}
			}
			$n = count($ar_menu);
			$c = 10;
			?>
			<li>
				<a href="<?php echo $value['tenkhongdau'] ?>"><?php echo $value['ten'] ?></a>
				<div class="container-sub-menu">
					<div class="grid">
						<?php foreach ($ar_menu as $k => $v){ ?>
							<?php if( $k == 0 || $k % $c == 0 ) { ?>
								<div class="col-flex-3">
								<?php } ?>
								<?php echo $v ?>
								<?php if( ($k + 1) % $c == 0 || $k + 1 == $c ) { ?>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</li>
		<?php } ?>
	</ul>
</div>