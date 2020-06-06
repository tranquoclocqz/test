<?php 
$data = _result_array("SELECT ten,tenkhongdau,id from table_option where type like 'status'"); 
$ar_trangthai = array();
foreach ($data as $key => $value) {
  $ar_trangthai['id_'.$value['id']]['ten'] = $value['ten'];
} ?>
<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
     <li><a href="index.php?com=order&act=man"><span>Đơn hàng</span></a></li>
     <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
   </ul>
   <div class="clear"></div>
 </div>
</div>

<script src="js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".datetimepicker").datetimepicker({
      yearOffset:222,
      lang:'ch',
      timepicker:false,
      format:'m/d/Y',
      formatDate:'Y/m/d',
      minDate:'-1970/01/02', // yesterday is minimum date
      maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
  });
</script>

<div class="widget" style="margin-bottom: 10px">
  <div class="titlee">
    <div class="timkiem" >
      <form name="search" action="index.php" method="GET" class="form giohang_ser">
        <input name="com" value="order" type="hidden"  />
        <input name="act" value="man" type="hidden" />
        <input name="p" value="<?=($_GET['p']=='')?'1':$_GET['p']?>" type="hidden" />
        <input class="form_or" name="keyword" placeholder="Nhập từ khóa.." value="<?=$_GET['keyword']?>" type="text" />
        <input class="form_or" autocomplete="off" name="ngaybd" id="datefm" type="text" value="<?=$_GET['ngaybd']?>" placeholder="Từ ngày.."/>
        <input class="form_or" autocomplete="off" name="ngaykt" id="dateto" type="text" value="<?=$_GET['ngaykt']?>" placeholder="Đến ngày.." />
        <?php if ($config_member): ?>
          <select name="member">
            <option value="0">Thành viên</option>
            <?php  
            $sql="select id,email from #_member order by id";
            $d->query($sql);
            $tinhtrang_sr = $d->result_array();
            for ($i=0,$count=count($tinhtrang_sr); $i < $count; $i++) { 
              ?>
              <option value="<?=$tinhtrang_sr[$i]["id"]?>" <?php if($tinhtrang_sr[$i]["id"]==$_GET['member']) echo "selected='selected'";?> >
                <?=$tinhtrang_sr[$i]["email"]?>
              </option>
            <?php }?>
          </select>
        <?php endif ?>
          <select name="tinhtrang">
            <option value="">Tình trạng</option>
            <option value="0">Mới đặt</option>
            <?php  
            foreach($data as $v) { 
              ?>
              <option value="<?=$v["id"]?>" <?php if($v["id"]==$_GET['tinhtrang']) echo "selected='selected'";?> >
                <?=$v["ten"]?>
              </option>
            <?php }?>
          </select>
        <input type="submit" class="blueB" value="Tìm kiếm" style="width:100px; margin:0px 0px 0px 10px;"  />
      </form>
    </div><!--end tim kiem-->
  </div>
</div>

<script language="javascript">
 function CheckDelete(l){
  if(confirm('Bạn có chắc muốn xoá đơn hàng này?'))
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

      <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('index.php?com=order&act=man&multi=del');return false;" />
    </div>  

  </div>



  <div class="widget">
    <div class="title"><span class="titleIcon">
      <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách đơn hàng</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="sortCol" width="120"><div>Mã đơn hàng<span></span></div></td>     
        <td class="sortCol"><div>Họ tên<span></span></div></td>
        <td class="sortCol" width="150"><div>Ngày đặt<span></span></div></td>
        <td width="150">Số tiền</td>
        <?php if ($config_member): ?>
          <td width="150">Thành viên</td>
        <?php endif ?>
        <td width="150">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10"><div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>     </div></td>
      </tr>
    </tfoot>
    <tbody>
     <?php for($i=0, $count=count($items); $i<$count; $i++){?>
       <tr>
         <td>
          <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
          <?=$items[$i]['madonhang']?>
        </td> 
        <td <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
         <?=$items[$i]['hoten']?>
       </td>
       <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>

        <?=date('d/m/Y - g:i A',$items[$i]['ngaytao']);?>
      </td>

      <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
       <?=number_format(get_tong_tien($items[$i]['id']),0, ',', '.')?>&nbsp;VNĐ
     </td>
     <?php if ($config_member): ?>    
      <td align="center" <?php if($items[$i]['view']==0){ echo "style='font-weight:bold;'";}?>>
       <?php 
       $sql="select id,email from #_member where id= '".$items[$i]['mathanhvien']."' ";
       $d->query($sql);
       $result=$d->fetch_array();
       echo $result['email'];
       ?>
     </td>
      <?php endif ?>
    
   <td class="actBtns">
    <a href="index.php?com=order&act=edit&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Xem và sửa đơn hàng"><img src="./images/icons/dark/preview.png" alt=""></a>
    <a href="" onclick="CheckDelete('index.php?com=order&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa đơn hàng"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
  </tr>
<?php } ?>
</tbody>
</table>
</div>
</form>               


<script type="text/javascript">
  function onSearch(evt) {	
    var datefm = document.getElementById("datefm").value;	
    var dateto = document.getElementById("dateto").value;
    var status = document.getElementById("id_tinhtrang").value;		
		//var encoded = Base64.encode(keyword);
		location.href = "index.php?com=order&act=man&datefm="+datefm+"&dateto="+dateto+"&status="+status;
		loadPage(document.location);

  }
  $(document).ready(function(){						
   var dates = $( "#datefm, #dateto" ).datepicker({
     defaultDate: "+1w",
     dateFormat: 'dd/mm/yy',
     changeMonth: true,			
     onSelect: function( selectedDate ) {
      var option = this.id == "datefm" ? "minDate" : "maxDate",
      instance = $( this ).data( "datepicker" ),
      date = $.datepicker.parseDate(
        instance.settings.dateFormat ||
        $.datepicker._defaults.dateFormat,
        selectedDate, instance.settings );
      dates.not( this ).datepicker( "option", option, date );
    }
  });

 });

</script>