
<div class="control_frm form" style="margin-top:25px;">
	<div class="box-header with-border">
		<h3>Rss</h3>
	</div>
	<div class="formRow">
		<div class="overlay"><img src="images/ajax-loader.gif"/></div>
		<script src="js/queue/src/jQuery.ajaxQueue.js" async type="text/javascript"></script>
		
		<input type="text" id="url-tin" value="https://batdongsan.com.vn/Modules/RSS/RssDetail.aspx?catid=38&typeid=1" style="width:500px;padding:6px"  />
		<button id="add-list" class="btn btn-primary add-list">GET RSS</button>&nbsp;<br/><br/>
		
	</div>
	<div id="contentrss">
		<table class="table table-bordered hide " id="tbl">
			<thead>
				<tr>
					<td>#</td>
					<td>Hình ảnh</td>
					<td>Tên</td>
					<td>Trạng thái</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
			
		</table>
		<button class="btn btn-success" id="get-item">LẤY TIN</button>
	</div>
</div>
<script>
	var base_url ="<?php echo $url_web ?>";
	var getLocation = function(href) {
		var l = document.createElement("a");
		l.href = href;
		return l;
	};
	
	$().ready(function(){
		
		$("#get-item").unbind("click");
		$("#get-item").click(function(){
			$("#tbl tr").each(function(){
				$(this).attr("class","");
				$(this).attr("class","check_"+($(this).find("input[type=checkbox]").is(":checked") ? '1' : 0));
				
				
			})
			
			$("#tbl tr.check_1").each(function(){	
				
				var $obj = $(this);
				
				if($obj.find("a").length){
					jQuery.ajaxQueue({
						url:base_url+"/admin/index.php?com=baiviet&act=rss&method=get-item",
						data:{"url":$obj.find("a").attr("href"),'image':$obj.find("img").attr("src"),"name":$obj.find("a").html()},
						type:'post',
						dataType: "json",
						beforeSend:function(){
							$obj.addClass("is-process");
							$("tr.is-process").find("td").last().addClass("orange").html("Đang xử lý");
							
						},
						
					}).done(function( data ) {
						$obj = $("tr.is-process");
						$obj.find("td").last().attr("class","");
						$obj.find("td").last().addClass(data.cls).html(data.stt);
						
						
						//console.log(data);
					});
				}
			})
			
			return false;
		})
		$(".add-list").click(function(){
			$obj = $(this);
			$(".overlay").show();
			$url = $obj.prev().val();
			
			var l = getLocation($url);
			alert(l);
			$array = new Array();
			$array = ['vnexpress','thanhnien.com.vn','24h.com.vn','baoxaydung','gdt.gov.vn','batdongsan.com.vn'];
			$get = false;
			if(l.hostname){
				$.each($array,function(i,item){
					$x = l.hostname;
					//console.log($x.indexOf(item));
					if($x.indexOf(item) != -1){
						$get = true;
					}				
				})
			}
			if($get){
				$.ajax({
					url:base_url+"/admin/index.php?com=baiviet&act=rss&method=getlist",
					data:{'url':$url},
					type:'post',
					success:function(data){
						$("#tbl tbody").empty();
						console.log(data);
						$jdata = $.parseJSON(data);
						$.each($jdata,function(i,item){
							//console.log(item);
							
							$content = "<tr><td><input type='checkbox' /></td><td><img width=50 src='"+item.image+"' /></td><td><a href='"+item.link+"'>"+item.name+"</a></td><td>Đang chờ</td></tr>";
							
							$("#tbl tbody").append($content);
							
							$("#tbl").removeClass("hide");
							$(".overlay").hide();
							
						})
						return false;
					}
				})
			}else{
				alert("Tin này không lấy được!");
				$("#url-tin").focus();
				$(".overlay").hide();
				return false;
				
			}
			return false;
		})
		//$("#add-list").trigger("click");
		//$("#add-list").remove();
	})
</script>
<style>
.table-bordered thead{margin-bottom:10px;}
.table-bordered tr th{padding:0 10px;}
.table-bordered tbody tr{padding:0 10px;}
.red{color:red}
.green{color:green}
.orange{color:orange}
.overlay{display:none; position: absolute;right: 50%;  top: 50%;}
</style>