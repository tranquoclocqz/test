<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="index.php?com=yahoo&act=man"><span>Hỗ trợ trực tuyến</span></a></li>
     <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
   </ul>
   <div class="clear"></div>
 </div>
</div>
<script language="javascript">
  function CheckDelete(l){
    if(confirm('Bạn có chắc muốn xoá mục này?'))
    {
      location.href = l;  
    }
  } 
  function ChangeAction(str){
    if(confirm("Bạn có chắc chắn?"))
    {
      document.f.action = str;
      document.f.submit();
    }
  }   
</script>
<form name="f" id="f" method="post">
  <div class="control_frm" style="margin-top:0;">
    <div style="float:left;">
      <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=yahoo&act=add&type=<?=$_GET['type']?>'" />
    </div>    
  </div>



  <div class="widget">
    <div class="title"><span class="titleIcon">
      <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách nick hỗ trợ hiện có</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>
        <td class="sortCol"><div>Tên<span></span></div></td>
        <td class="sortCol"><div>Điện thoại<span></span></div></td>
        <?php if ($config_social): ?>
          <td class="sortCol"><div>Email<span></span></div></td>
          <td class="sortCol"><div>Viber<span></span></div></td>
          <td class="sortCol"><div>Facebook<span></span></div></td>
          <td class="sortCol"><div>Zalo<span></span></div></td>
          <td class="sortCol"><div>Skype<span></span></div></td>

        <?php endif ?>
        <td class="tb_data_small">Ẩn/Hiện</td>
        <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="11">
          <div class="pagination">
            <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>            
          </div></td>
        </tr>
      </tfoot>
      <tbody>
        <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
            <td>
              <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
            </td>
            <td align="center">
              <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText" original-title="Nhập số thứ tự danh mục" id="number<?=$items[$i]['id']?>" onchange="return updateNumber('yahoo', '<?=$items[$i]['id']?>')" />
              <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
            </td>       
            <td style="width: 150px">
              <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
            </td>
            <td class="title_name_data  text-center">
              <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold"><?=$items[$i]['dienthoai']?></a>
            </td>
            <?php if ($config_social): ?>
              <td class="title_name_data">
                <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold"><?=$items[$i]['email']?></a>
              </td>
              <td class="title_name_data">
                <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold"><?=$items[$i]['viber']?></a>
              </td>
              <td class="title_name_data">
                <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold"><?=$items[$i]['facebook']?></a>
              </td>

              <td class="title_name_data">
                <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold"><?=$items[$i]['yahoo']?></a>
              </td>

              <td class="title_name_data">
                <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" class="tipS SC_bold"><?=$items[$i]['skype']?></a>
              </td>


            <?php endif ?>
            <td align="center">
              <a data-val2="table_<?=$_GET['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
            </td>

            <td class="actBtns">
              <a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="" class="smallButton tipS" original-title="Sửa danh mục"><img src="./images/icons/dark/pencil.png" alt=""></a>
              <a href="" onclick="CheckDelete('index.php?com=yahoo&act=delete&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa danh mục"><img src="./images/icons/dark/close.png" alt=""></a>
            </td>
          </tr>
        <?php } ?> 
      </tbody>
    </table>
  </div>
</form>               