<?php
echo $row_setting['scriptbottom'];
echo $row_setting['vchat'];
ob_start("ob_html_compress");
?>
<script src="js/core.js" defer></script>   
<?php if($template == 'index'){ ?>
  <script src="js/jssor/jssor.slider-28.0.0.min.js"></script> 
<?php } ?>
<script>
  <?php if (preg_match('/detail/',$template)) { ?>
    var script = document.createElement('script');
    script.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0';
    script.async = true;
    script.defer = true;
    script.crossorigin = "anonymous";
    document.getElementsByTagName('head')[0].appendChild(script);
  <?php } else { ?>
    var fired = false;
    window.addEventListener("scroll", function(){
      if ((document.documentElement.scrollTop != 0 && fired === false) || (document.body.scrollTop != 0 && fired === false)) {
        var script = document.createElement('script');
        script.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0';
        script.async = true;
        script.defer = true;
        script.crossorigin = "anonymous";
        document.getElementsByTagName('head')[0].appendChild(script);
        fired = true;
      }
    }, true);
  <?php } ?>
  <?php if ($config['google_recaptcha_v3']) { ?>
    $(function() {
      var _flag = true;
      $("form").click(function(event) {
        if (_flag) {
          trihoan_js("https://www.google.com/recaptcha/api.js?render=<?php echo $config['site_key'] ?>",function(){
            grecaptcha.ready(function() {
              grecaptcha.execute('<?php echo $config['site_key'] ?>', {
                action: '<?php echo $action = ($com == '') ? 'index' : str_replace('-', '', $com) ?>'
              }).then(function(token) {
                <?php if ($template == 'contact') { ?>
                  var recaptchaResponse = document.getElementById('recaptchaResponse');
                  recaptchaResponse.value = token;
                <?php } ?>
                var recaptchaResponse = document.getElementById('recaptchaResponse2');
                recaptchaResponse.value = token;
              });
            });
          });
          _flag = false;
        }
      });
    });
  <?php } ?>
  <?php if($template == 'index'){ ?>
    window.jssor_1_slider_init = function() {
      var $transition = [{
        $Duration: 800,
        $Opacity: 2
      }, {
        $Duration: 500,
        $Delay: 12,
        $Cols: 10,
        $Rows: 5,
        $Opacity: 2,
        $Clip: 15,
        $SlideOut: !0,
        $Formation: $JssorSlideshowFormations$.$FormationStraightStairs,
        $Assembly: 2049,
        $Easing: $Jease$.$OutQuad
      }, {
        $Duration: 500,
        $Delay: 12,
        $Cols: 10,
        $Rows: 5,
        $Opacity: 2,
        $Clip: 15,
        $Formation: $JssorSlideshowFormations$.$FormationStraightStairs,
        $Assembly: 2050,
        $Easing: {
          $Clip: $Jease$.$InSine
        }
      }, {
        $Duration: 500,
        x: -1,
        $Delay: 40,
        $Cols: 10,
        $Rows: 5,
        $SlideOut: !0,
        $Easing: {
          $Left: $Jease$.$InCubic,
          $Opacity: $Jease$.$OutQuad
        },
        $Opacity: 2
      }],
      $jssor_1_SlideoTransitions = [
      [{b:0,d:800,o:1}]
      ];

      $jssor_1_options = {

        $AutoPlay: 1,
        $SlideshowOptions: {
          $Class: $JssorSlideshowRunner$,
          $Transitions: $transition,
          $TransitionsOrder: 1
        },
        $CaptionSliderOptions: {
          $Class: $JssorCaptionSlideo$,
          $Transitions: $jssor_1_SlideoTransitions
        },
        $ArrowNavigatorOptions: {
          $Class: $JssorArrowNavigator$
        },
        $BulletNavigatorOptions: {
          $Class: $JssorBulletNavigator$,
          
        }
      };
      var jssor_1_slider = new $JssorSlider$("jssor_1", $jssor_1_options);
      var MAX_WIDTH = 3000;
      function ScaleSlider() {
        var containerElement = jssor_1_slider.$Elmt.parentNode;
        var containerWidth = containerElement.clientWidth;
        if (containerWidth) {
          var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
          jssor_1_slider.$ScaleWidth(expectedWidth);
        }
        else {
          window.setTimeout(ScaleSlider, 30);
        }
      }
      ScaleSlider();
      $Jssor$.$AddEvent(window, "load", ScaleSlider);
      $Jssor$.$AddEvent(window, "resize", ScaleSlider);
      $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
    };
    jssor_1_slider_init();
  <?php } ?>
</script>