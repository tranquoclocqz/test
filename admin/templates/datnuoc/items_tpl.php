<script type="text/javascript">
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'datnuoc';
			var value = $(this).val();
			$.ajax ({
				type: "POST",
				url: "ajax/update_stt.php",
				data: {id:id,table:table,value:value},
				success: function(result) {
				}
			});
		});
		$('.timkiem button').click(function(event) {
			var keyword = $(this).parent().find('input').val();
			window.location.href="index.php?com=datnuoc&act=man&keyword="+keyword;
		});
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value; 
        })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=datnuoc&act=delete_cat&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
	});

 
</script>



<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=datnuoc&act=man"><span>Danh sách các nước muốn xin visa</span></a></li>
        	<?php if($_GET['keyword']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;">Kết quả tìm kiếm " <?=$_GET['keyword']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<form name="f" id="f" method="post">

<div class="widget">
  <div class="title">
    <div class="timkiem" style="padding-left: 3px;">
	    <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">
	    <button type="button" class="blueB"  value="">Tìm kiếm</button>
    </div>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>     
        <td class="sortCol"><div>Tên nước<span></span></div></td>

        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>

    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>

       
        <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự" rel="<?=$items[$i]['id']?>" />

            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 

    
        <td class="title_name_data">
            <a href="index.php?com=datnuoc&act=edit&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['ten']?></a>
        </td>
       
        <td align="center">
          <a data-val2="table_datnuoc" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
        </td>
       
        <td class="actBtns">
            <a href="index.php?com=datnuoc&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>
        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>  

<div class="paging"><?=$paging?></div>