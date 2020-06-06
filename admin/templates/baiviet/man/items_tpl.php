<script type="text/javascript">
	$(document).ready(function() {
		$('.update_stt').keyup(function(event) {
			var id = $(this).attr('rel');
			var table = 'baiviet';
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
			window.location.href="index.php?com=baiviet&act=man&type=<?=$_GET['type']?>&keyword="+keyword;
		});
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
      })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=baiviet&act=delete&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
  });
 function select_linhvuc()
 {
  var a=document.getElementById("id_linhvuc");
  window.location ="index.php?com=baiviet&act=man&type=<?=$_GET['type']?>&id_linhvuc="+a.value; 
  return true;
}

function select_list()
{
  var a=document.getElementById("id_list");
  var b=document.getElementById("id_linhvuc");
  window.location ="index.php?com=baiviet&act=man&type=<?=$_GET['type']?>&id_list="+a.value<?php if (isset($_GET['id_linhvuc'])): ?>
      +"&id_linhvuc="+b.value
    <?php endif ?>;
  return true;
}

function select_cat()
{
  var a=document.getElementById("id_list");
  var b=document.getElementById("id_cat");
  var c=document.getElementById("id_linhvuc");
  window.location ="index.php?com=baiviet&act=man&type=<?=$_GET['type']?>&id_list="+a.value+"&id_cat="+b.value<?php if (isset($_GET['id_linhvuc'])): ?>
      +"&id_linhvuc="+c.value
    <?php endif ?>;
  return true;
}
function select_item()
{
  var a=document.getElementById("id_list");
  var b=document.getElementById("id_cat");
  var c=document.getElementById("id_item");
  var c=document.getElementById("id_linhvuc");
  window.location ="index.php?com=baiviet&act=man&type=<?=$_GET['type']?>&id_list="+a.value+"&id_cat="+b.value+"&id_item="+c.value<?php if (isset($_GET['id_linhvuc'])): ?>
      +"&id_linhvuc="+d.value
    <?php endif ?>; 
  return true;
}
function select_sub()
{
  var a=document.getElementById("id_list");
  var b=document.getElementById("id_cat");
  var c=document.getElementById("id_item");
  var d=document.getElementById("id_sub");
  var d=document.getElementById("id_linhvuc");
  window.location ="index.php?com=baiviet&act=man&type=<?=$_GET['type']?>&id_list="+a.value+"&id_cat="+b.value+"&id_item="+c.value+"&id_sub="+d.value<?php if (isset($_GET['id_linhvuc'])): ?>
      +"&id_linhvuc="+e.value
    <?php endif ?>; 
  return true;
}

</script>
<?php
function get_linhvuc()
{
  $sql="select * from table_linhvuc where hienthi = 1";
  $stmt=_result_array($sql);
  $str='
  <select id="id_linhvuc" name="id_linhvuc" onchange="select_linhvuc()" class="main_select">
  <option value="">Chọn lĩnh vực</option>';
  foreach ($stmt as $row) 
  {
    if($row["id"]==(int)@$_REQUEST["id_linhvuc"])
      $selected="selected";
    else 
      $selected="";
    $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
  }
  $str.='</select>';
  return $str;
}
function get_main_list()
{
  $sql="select * from table_baiviet_list where type='".$_GET['type']."' order by stt asc";
  $stmt=_result_array($sql);
  $str='
  <select id="id_list" name="id_list" onchange="select_list()" class="main_select">
  <option value="">Chọn danh mục 1</option>';
  foreach ($stmt as $row) 
  {
    if($row["id"]==(int)@$_REQUEST["id_list"])
      $selected="selected";
    else 
      $selected="";
    $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
  }
  $str.='</select>';
  return $str;
}

function get_main_cat()
{
  $sql="select * from table_baiviet_cat where id_list='".$_GET['id_list']."' and type='".$_GET['type']."' order by stt asc";
  $stmt=_result_array($sql);
  $str='
  <select id="id_cat" name="id_cat" onchange="select_cat()" class="main_select">
  <option value="">Chọn danh mục 2</option>';
  foreach ($stmt as $row)
  {
    if($row["id"]==(int)@$_REQUEST["id_cat"])
      $selected="selected";
    else 
      $selected="";
    $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
  }
  $str.='</select>';
  return $str;
}

function get_main_item()
{
  $sql="select * from table_baiviet_item where id_cat='".$_GET['id_cat']."' and type='".$_GET['type']."' order by stt asc";
  $stmt=_result_array($sql);
  $str='
  <select id="id_item" name="id_item" onchange="select_item()" class="main_select">
  <option value="">Chọn danh mục 3</option>';
  foreach ($stmt as $row) 
  {
    if($row["id"]==(int)@$_REQUEST["id_item"])
      $selected="selected";
    else 
      $selected="";
    $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
  }
  $str.='</select>';
  return $str;
}
function get_main_sub()
{
  $sql="select * from table_baiviet_sub where id_item='".$_GET['id_item']."' and type='".$_GET['type']."' order by stt asc";
  $stmt=_result_array($sql);
  $str='
  <select id="id_sub" name="id_sub" onchange="select_sub()" class="main_select">
  <option value="">Chọn danh mục 4</option>';
  foreach ($stmt as $row) 
  {
    if($row["id"]==(int)@$_REQUEST["id_sub"])
      $selected="selected";
    else 
      $selected="";
    $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';      
  }
  $str.='</select>';
  return $str;
}
?>

<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="index.php?com=baiviet&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Quản lý <?=$title_main ?></span></a></li>
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
  <div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
     <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=baiviet&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
     <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />
     <?php if ($config_info): 
       if ($_GET['type']=='thuvien') {
        $add = '-info';
      }
      ?>
      <input type="button" class="blueB" value="Thêm thông tin" onclick="location.href='index.php?com=info&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'].$add;?>'" />
    <?php endif ?>
  </div>  
</div>

<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
  </span>
  <h6>Chọn tất cả</h6>
  <div class="timkiem">
   <input type="text" value="" placeholder="Nhập từ khóa tìm kiếm ">
   <button type="button" class="blueB"  value="">Tìm kiếm</button>
 </div>
</div>
<div class="table-responsive">
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>     
        <?php if ($config_linhvuc): ?>
          <td class="tb_data_small">
            <?php echo get_linhvuc(); ?>
          </td> 
        <?php endif ?>
        <?php if($config_list){ ?>
          <td class="tb_data_small"><?=get_main_list()?></td>
        <?php } ?>
        <?php if($config_cat){ ?> 
          <td class="tb_data_small"><?=get_main_cat()?></td>
        <?php } ?>
        <?php if($config_item){ ?> 
          <td class="tb_data_small"><?=get_main_item()?></td>
        <?php } ?>
        <?php if($config_sub){ ?> 
          <td class="tb_data_small"><?=get_main_sub()?></td>
        <?php } ?>
        <?php if ($config_images): ?>
          <td style="width: 85px"></td>
        <?php endif ?>
        <td class="sortCol post_name"><div>Tên bài viết<span></span></div></td>
        <?php if($config_noibat){ ?> 
          <td class="tb_data_small"><?php echo $config_text_noibat ?></td>
        <?php } ?>
        <?php if($config_banchay){ ?> 
          <td class="tb_data_small"><?php echo $config_text_banchay ?></td>
        <?php } ?>
        <?php if($config_footer){ ?> 
          <td class="tb_data_small">Footer</td>
        <?php } ?>
        <?php if($_GET['type'] != 'slogan2'){ ?>
          <td class="tb_data_small">Ẩn/Hiện</td>
          <td width="200">Thao tác</td>
        <?php } ?>
      </tr>
    </thead>

    <tbody>
     <?php for($i=0, $count=count($items); $i<$count; $i++){?>
       <tr>
         <td>
          <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>


        <td align="center">
          <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự bài viết" rel="<?=$items[$i]['id']?>" />

          <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
        </td> 
        <?php if ($config_linhvuc): ?>
          <td align="center">
           <?php
           $tenlinhvuc = _fetch_array("select ten_vi from table_linhvuc where id='".$items[$i]['id_linhvuc']."'");
           echo $tenlinhvuc['ten_vi'];
           ?>  
         </td>
       <?php endif ?>
       <?php if($config_list){ ?>
        <td align="center">
          <?php
          $d->reset();
          $sql = "select ten_vi from table_baiviet_list where id='".$items[$i]['id_list']."'";
          $name_danhmuc =_fetch_array($sql);
          echo @$name_danhmuc['ten_vi'];
          ?>  
        </td>
      <?php } ?> 
      <?php if($config_cat){ ?>
        <td align="center">
          <?php
          $d->reset();
          $sql = "select ten_vi from table_baiviet_cat where id='".$items[$i]['id_cat']."'";
          
          $name_danhmuc =_fetch_array($sql);
          echo @$name_danhmuc['ten_vi'];
          ?>  
        </td>
      <?php } ?> 
      <?php if($config_item){ ?>
        <td align="center">
          <?php
          $d->reset();
          $sql = "select ten_vi from table_baiviet_item where id='".$items[$i]['id_item']."'";
          
          $name_danhmuc =_fetch_array($sql);
          echo @$name_danhmuc['ten_vi'];
          ?>  
        </td>
      <?php } ?> 
      <?php if($config_sub){ ?>
        <td align="center">
          <?php
          $d->reset();
          $sql = "select ten_vi from table_baiviet_sub where id='".$items[$i]['id_sub']."'";
          
          $name_danhmuc =_fetch_array($sql);
          echo @$name_danhmuc['ten_vi'];
          ?>  
        </td>
      <?php } ?> 
      <?php if ($config_images): ?>
       <td style="width: 85px">
        <a href="index.php?com=baiviet&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><img src="<?php echo _upload_baiviet.$items[$i]['photo'] ?>" alt="" style="background: #ccc" class="img-responsive"></a>
      </td>
      <?php endif ?>
      <td class="title_name_data post_name">
        <a href="index.php?com=baiviet&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
      </td>
      <?php if($config_noibat){ ?> 
        <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
      <?php } ?>

      <?php if($config_banchay){ ?> 
        <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['banchay']?>" data-val3="banchay" class="diamondToggle <?=($items[$i]['banchay']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
      <?php } ?>
      <?php if($config_footer){ ?> 
        <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['footer']?>" data-val3="footer" class="diamondToggle <?=($items[$i]['footer']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
      <?php } ?>

      <?php if($_GET['type'] != 'slogan2'){ ?>
        <td align="center">
          <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
        </td>

        <td class="actBtns">
          <a href="index.php?com=baiviet&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id_sub=<?=$items[$i]['id_sub']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa bài viết"><img src="./images/icons/dark/pencil.png" alt=""></a>

          <a href="index.php?com=baiviet&act=delete&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa bài viết"><img src="./images/icons/dark/close.png" alt=""></a>
        </td>
      <?php } ?>
    </tr>
  <?php } ?>
</tbody>
</table>
</div>
</div>
</form>  

<div class="paging"><?=$paging?></div>