<?php
function get_list_role($id=0){

	$sql="select * from table_user_role order by stt";
	$stmt=_result_array($sql);
	$str='
	<select id="id_role" name="id_role" class="main_font">
	<option>Chọn nhóm thành viên</option>			
	';
	foreach ($stmt as $row)
	{
		if($row["id"]==$id)
			$selected="selected";
		else 
			$selected="";
		$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
	}
	$str.='</select>';
	return $str;

}
?>
<div class="control_frm" style="margin-top:25px;">
	<div class="bc">
		<ul id="breadcrumbs" class="breadcrumbs">
			<li><a href="index.php?com=member&act=man"><span>Danh sách thành viên</span></a></li>
			<li class="current"><a href="#" onclick="return false;">Chỉnh sửa thành viên</a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=member&act=save" method="post" enctype="multipart/form-data">	        
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/pencil.png" alt="" class="titleIcon" />
			<h6>Thông tin tài khoản</h6>
		</div>	
        <div class="formRow">
            <label>Họ và tên</label>
            <div class="formRight">
                <input type="text" readonly value="<?=@$item['ten']?>" name="ten" title="Nhập ten của bạn" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
        	<label>Email</label>
        	<div class="formRight">
        		<input type="text" readonly value="<?=@$item['email']?>" name="email" title="Nhập email của bạn" class="tipS" />
        	</div>
        	<div class="clear"></div>
        </div>

        <div class="formRow">
          <div class="formRight">
             <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
             <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
         </div>
         <div class="clear"></div>
     </div> 			
 </div>


</form>   
<script>
	$(document).ready(function() {
		 //Chọn ngày sinh
		 $("#ngaysinh" ).datepicker({      
		 	dateFormat: 'dd/mm/yy',
		 	changeYear: true,
		 	closeText: "Close",
		 	yearRange: "1900:+nn",
		 });
		});	
	</script>