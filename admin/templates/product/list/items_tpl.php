<script type="text/javascript">
  $(document).ready(function() {
    $('.update_stt').keyup(function(event) {
      var id = $(this).attr('rel');
      var table = 'product_list';
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
      window.location.href="index.php?com=product&act=man_list&type=<?=$_GET['type']?>&keyword="+keyword;
    });
    $("#xoahet").click(function(){
      var listid="";
      $("input[name='chon']").each(function(){
        if (this.checked) listid = listid+","+this.value;
      })
      listid=listid.substr(1);   //alert(listid);
      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
      hoi= confirm("Bạn có chắc chắn muốn xóa?");
      if (hoi==true) document.location = "index.php?com=product&act=delete_list&type=<?=$_GET['type']?>&curPage=<?=$_GET['curPage']?>&listid=" + listid;
    });
  });
</script> 

<div class="control_frm" style="margin-top:25px;">
  <div class="bc">
    <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="index.php?com=product&act=man_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Danh mục cấp 1</span></a></li>
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
      <input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=product&type=<?=$_GET['type']?>&act=add_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
      <input type="button" class="blueB" value="Xoá Chọn" id="xoahet" />

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
          <?php if ($config_images): ?>
            <td> </td>
          <?php endif ?>

          <?php if ($config_quangcao): ?>
            <td> </td>
          <?php endif ?>

          <td class="sortCol"><div>Tên danh mục<span></span></div></td>
          <?php if($config_sale){ ?>
            <td class="tb_data_small"> <?php echo $config_text_sale ?> </td>
          <?php } if($config_km){ ?>
            <td class="tb_data_small"><?php echo $config_text_km ?></td>  
          <?php } if($config_ts){ ?>
            <td class="tb_data_small"><?php echo $config_text_ts ?></td>       
          <?php } if($config_bc){ ?>     
            <td class="tb_data_small"><?php echo $config_text_bc ?></td>       
          <?php } if($config_noibat){ ?>     
            <td class="tb_data_small">Nổi bật</td>       
          <?php } ?>
          <?php if($config_special){ ?>
            <td class="tb_data_small">Footer</td>
          <?php } ?>
          <td class="tb_data_small">Ẩn/Hiện</td>
          <td width="200">Thao tác</td>
        </tr>
      </thead>

      <tbody>
       <?php for($i=0, $count=count($items); $i<$count; $i++){?>
         <tr>
           <td>
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
          </td>
          <td align="center">
            <input type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeypress="return OnlyNumber(event)" class="tipS smallText update_stt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />

            <div id="ajaxloader"><img class="numloader" id="ajaxloader<?=$items[$i]['id']?>" src="images/loader.gif" alt="loader" /></div>
          </td> 
          
           <?php if ($config_images): ?>
            <td style="width: 50px">
              <div>
                <a href="index.php?com=product&act=edit_list&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold">
                  <img src="<?php echo _upload_product.$items[$i]['photo'] ?>" alt="" style="max-width: 75px" class="img-responsive img-center">
                </a>
              </div>
            </td>
          <?php endif ?>

          <?php if ($config_quangcao): ?>
            <td style="width: 50px">
              <div>
                <a href="index.php?com=product&act=edit_list&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold">
                  <img src="<?php echo _upload_product.$items[$i]['quangcao'] ?>" alt="" class="img-responsive img-center">
                </a>
              </div>
            </td>
          <?php endif ?>

          <td class="title_name_data">
            <a href="index.php?com=product&act=edit_list&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" class="tipS SC_bold"><?=$items[$i]['ten_vi']?></a>
          </td>
          <?php if($config_sale){ ?>
            <td align="center">
              <a data-val2="table_<?=$_GET['com']?>_list" rel="<?=$items[$i]['sp_uudai']?>" data-val3="sp_uudai" class="diamondToggle <?=($items[$i]['sp_uudai']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
            </td>
          <?php } ?>
          <?php if($config_km){ ?>
            <td align="center">
              <a data-val2="table_<?=$_GET['com']?>_list" rel="<?=$items[$i]['sp_khuyenmai']?>" data-val3="sp_khuyenmai" class="diamondToggle <?=($items[$i]['sp_khuyenmai']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
            </td>
          <?php } if($config_ts){ ?>
            <td align="center">
              <a data-val2="table_<?=$_GET['com']?>_list" rel="<?=$items[$i]['banchay']?>" data-val3="banchay" class="diamondToggle <?=($items[$i]['banchay']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
            </td>
          <?php } if($config_bc){ ?>
            <td align="center">
              <a data-val2="table_<?=$_GET['com']?>_list" rel="<?=$items[$i]['sp_banchay']?>" data-val3="sp_banchay" class="diamondToggle <?=($items[$i]['sp_banchay']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
            </td>
          <?php } ?>
          <?php if($config_noibat){ ?>
            <td align="center">
              <a data-val2="table_<?=$_GET['com']?>_list" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
            </td>
          <?php } ?>
          <?php if($config_special){ ?>
            <td align="center">
              <a data-val2="table_<?=$_GET['com']?>_list" rel="<?=$items[$i]['special']?>" data-val3="special" class="diamondToggle <?=($items[$i]['special']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
            </td>
          <?php } ?>
          <td align="center">
            <a data-val2="table_<?=$_GET['com']?>_list" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
          </td>

          <td class="actBtns">
            <a href="index.php?com=product&act=edit_list&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>

            <a href="index.php?com=product&act=delete_list&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</div>
</form>  

<div class="paging"><?=$paging?></div>