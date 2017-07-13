

(function ($) {
    "use strict";
    var mainApp = {

        main_fun: function () {

            /*====================================
             Jquery Easing 插件
            ======================================*/
            $(function () {
                $('.move-me a').bind('click', function (event) { //just pass move-me in design and start scrolling
                    var $anchor = $(this);
                    $('html, body').stop().animate({
                        scrollTop: $($anchor.attr('href')).offset().top
                    }, 1000, 'easeInOutQuad');
                    event.preventDefault();
                });
            });
            /*====================================
            技能展示CHART
           ======================================*/
            $(function () {
                $('.chart').easyPieChart({
                    easing: 'easeOutBounce',
                    onStep: function (from, to, percent) {
                        $(this.el).find('.percent').text(Math.round(percent));
                    },
                    barColor: '#05D6AC', //进度条颜色
                    lineWidth: 10, //线宽
                    size: 150, //饼图大小像素(永远为正方形)
                    animate: 4000, //缓解动画
                });

            });
            /*====================================
           DOWNLOAD RESUME SECTION TOOL TIP SCRIPTS 
          ======================================*/
            $(function () {
                $('a[title]').tooltip();
            });
            /*====================================
      
            /*====================================
          PRETTYPHOTO FUNCTION
          ======================================*/

            $("a.preview").prettyPhoto({
                social_tools: false
            });
            /*====================================
             WOW PLUGIN SCRIPTS 
            ======================================*/
            new WOW().init();
        
	
            /*====================================
            WRITE YOUR SCRIPTS HERE
            ======================================*/





        },

        initialization: function () {
            mainApp.main_fun();

        }

    }
    // Initializing ///

    $(document).ready(function () {
        mainApp.main_fun();
    });

}(jQuery));
