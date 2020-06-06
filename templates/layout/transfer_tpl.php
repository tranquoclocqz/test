<HTML>
<head>
  <TITLE>Thông báo chuyển trang</TITLE>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="REFRESH" content="1; url=<?=$page_transfer?>">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>


  <style>
    table,table tr, table td{
      border-collapse: collapse;
      border: 1px solid #ff8c00;
    }
    .meter { 
      height: 20px;  /* Can be anything */
      position: relative;
      margin: 0; /* Just for demo spacing */
      background: #FFFFFF;
      padding: 10px;
      -webkit-box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
      -moz-box-shadow   : inset 0 -1px 1px rgba(255,255,255,0.3);
      box-shadow        : inset 0 -1px 1px rgba(255,255,255,0.3);
    }
    .meter > span {
      display: block;
      height: 100%;
      
      background-color: rgb(255,140,0);
      background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(0, rgb(255,140,0)),
        color-stop(1, rgb(255,140,0))
        );
      background-image: -moz-linear-gradient(
        center bottom,
        rgb(255,140,0) 37%,
        rgb(255,140,0) 69%
        );
      -webkit-box-shadow: 
      inset 0 2px 9px  rgba(255,255,255,0.3),
      inset 0 -2px 6px rgba(0,0,0,0.4);
      -moz-box-shadow: 
      inset 0 2px 9px  rgba(255,255,255,0.3),
      inset 0 -2px 6px rgba(0,0,0,0.4);
      box-shadow: 
      inset 0 2px 9px  rgba(255,255,255,0.3),
      inset 0 -2px 6px rgba(0,0,0,0.4);
      position: relative;
      overflow: hidden;
    }
    .meter > span:after, .animate > span > span {
      content: "";
      position: absolute;
      top: 0; left: 0; bottom: 0; right: 0;
      background-image: 
      -webkit-gradient(linear, 0 0, 100% 100%, 
        color-stop(.25, rgba(255, 255, 255, .2)), 
        color-stop(.25, transparent), color-stop(.5, transparent), 
        color-stop(.5, rgba(255, 255, 255, .2)), 
        color-stop(.75, rgba(255, 255, 255, .2)), 
        color-stop(.75, transparent), to(transparent)
        );
      background-image: 
      -moz-linear-gradient(
        -45deg, 
        rgba(255, 255, 255, .2) 25%, 
        transparent 25%, 
        transparent 50%, 
        rgba(255, 255, 255, .2) 50%, 
        rgba(255, 255, 255, .2) 75%, 
        transparent 75%, 
        transparent
        );
      z-index: 1;
      -webkit-background-size: 50px 50px;
      -moz-background-size: 50px 50px;
      -webkit-animation: move 2s linear infinite;

      overflow: hidden;
    }

    .animate > span:after {
      display: none;
    }

    @-webkit-keyframes move {
      0% {
       background-position: 0 0;
     }
     100% {
       background-position: 50px 50px;
     }
   }


   .nostripes > span > span, .nostripes > span:after {
    -webkit-animation: none;
    background-image: none;
  }
  span.percent{
    width: 0%;
  }
  .meter strong{
    font-size: 13px;
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 99999;
    width: 100%;
    height: 40px;
    line-height: 40px;
    text-align: center;
    color: #D90000;
  }
</style>
</head>
<body>
  <script type="text/javascript">
    $(document).ready(function(){
      var percent = 0;
      var total = 2;

      $("span.percent").animate({
        width: '100%'
      }, {
        duration:1000,
        step  : function(now, fx){
         $("strong").html(parseInt(now)+"%");

       }
     });
      



    })
  </script>
  <br/><br/><br/>
  <center>
    <table border="1" width="350" cellspacing="0" bordercolor="#CBE2EB" bgcolor="#efefef">
      <tr>
        <td colspan="" rowspan="" headers="">
          <div class="meter animate">
            <strong>0%</strong>
            <span class="percent"><span></span></span>
          </div>
        </td>
      </tr>
      <tr>
        <td width="350" align="center">
          <br/>
          <?=$showtext?><br>
          <br>-----------------------------------------<br>
          (<a href="<?=$page_transfer?>">Click vào đây nếu bạn không muốn đợi lâu </a>)
        </td>
      </tr>
    </table>
  </center>
</body>
</HTML>