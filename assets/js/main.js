$(document).ready(function() {
  $(".burger__button").click(function(){
    $(".burger_menu").css({'display':'block'});
  });
  $('.cross_burger').click(function(){
    $(".burger_menu").css({'display':'none'});
  });
  $('.slider-1').slick({
    dots: true,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    adaptiveHeight: true,
    arrows:true,
    prevArrow: '<button type="button" class="slick-prev">&larr;</button>',
    nextArrow: '<button type="button" class="slick-next">&rarr;</button>'
  });
  $('.btn-1').click(function(){
    $('.element-test').toggleClass("c-1");
  });
  $('.btn-2').click(function(){
    $('.element-test').toggleClass("c-2");
  });
  $('.btn-3').click(function(){
    $('.element-test').toggleClass("c-3");
  });










  function myFunction() {
    var value = parseInt($('.timer').find('span').text(), 10);
      value++;
      $('.timer').find('span').text(value);
  }
  $gulps = 0;
  $maxgulps = 0;
  $logtext = ' ';
  $('.button_play').click(function(){
    $('.button_play').css({"display":"none"});
    $flys = $('.fly__value').val();
    $logtext += 'Количество пчел - ' + $flys + '\n';
    $maxgulps = parseInt($('.gor__value').val());
    $logtext += 'Объем горшка - ' + $maxgulps + '\n';
    console.log($('.fly__value').val());
    $count = 0;
    
    // повторить с интервалом 2 секунды
    let timerId = setInterval(() => fly(++$count), 1000);

    // остановить вывод через 5 секунд
    setTimeout(() => { clearInterval(timerId); fly(++$count); }, 1000 * $flys - 500);
    console.log('муха 0');
  });

  $('.button_play').click(function(){
    $timer = 0;
    setInterval(myFunction, 1100); // every millisecond call updateDisplay
  });


  $('.see__log').click(function(){
    $('.log').text($logtext);
  });

  $('.savelog').click(function(){
    $('#comment').text($logtext);
    $('#submit').click();
  });

  $readyvivni = true;
  $readypiatochok = true;
  function lastfly(){
    if($readyvivni == true){
      $logtext += 'Винни просыпаеться \n';
      console.log('Винни просыпаеться');
      $('.vinipuh').animate({top: 0}, 5000, function(){
          console.log('Винни кушает');
          $logtext += 'Винни кушает \n';
          $readyvivni = false;
          $('.vinipuh').css({"margin-top": "-100px"});
          $('.vinipuh').animate({top: 0}, 300, function(){
            $('.vinipuh__scale__value').css({"transition": "30s all linear"});
            $('.vinipuh__scale__value').css({"width": "100%"});
            $string = '0%';
            $('.gorshok .after').css({"transition": "30s all linear"});
            $('.gorshok .after').animate({height: $string});
            $('.vinipuh').animate({top: 0}, 30000, function(){
              console.log('Винни покушал');
              $logtext += 'Винни покушал \n';
              $('.flys__item').css({"pointer-events": "auto"});
              $('.vinipuh').css({"margin-top": "0px"});
              $('.vinipuh__scale__value').css({"transition": "60s all linear"});
              $('.vinipuh__scale__value').css({"width": "0%"});
              $('.gorshok span.span span').text("0");
              $('.gorshok .after').css({"transition": "0.3s all linear"});
              $gulps = 0;
              $('.vinipuh').animate({top: 0}, 60000, function(){
                console.log('Винни проголодался');
                $logtext += 'Винни проголодался \n';
                $readyvivni = true;
              });
            });
          });
      });
    }else{
      $logtext += 'полёт к пяточку \n';
      console.log('полёт к пяточку');
      if($readypiatochok == true){
        $logtext += 'пяточок просыпаеться \n';
        console.log('пяточок просыпаеться');
        $('.piatochok').animate({top: 0}, 5000, function(){
          $logtext += 'пяточок кушает \n';
          console.log('пяточок кушает');
          $readypiatochok = false;
          $('.piatochok').css({"margin-top": "-100px"});
          $('.piatochok').animate({top: 0}, 300, function(){
            $('.piatochok__scale__value').css({"transition": "40s all linear"});
            $('.piatochok__scale__value').css({"width": "100%"});
            $string = '0%';
            $('.gorshok .after').css({"transition": "40s all linear"});
            $('.gorshok .after').animate({height: $string});
            $('.piatochok').animate({top: 0}, 40000, function(){
              $logtext += 'пяточок покушал \n';
              console.log('пяточок покушал');
              $('.flys__item').css({"pointer-events": "auto"});
              $('.piatochok').css({"margin-top": "0px"});
              $('.piatochok__scale__value').css({"transition": "40s all linear"});
              $('.piatochok__scale__value').css({"width": "0%"});
              $('.gorshok span.span span').text("0");
              $gulps = 0;
              $('.gorshok .after').css({"transition": "0.3s all linear"});
              $('.piatochok').animate({top: 0}, 40000, function(){
                $logtext += 'пяточок проголодался \n';
                console.log('пяточок проголодался');
                $readypiatochok = true;
              });
            });
          });
        });
      }else{
        $logtext += 'все спят \n';
        console.log('все спят');
        $('header').animate({top: 0}, 5000, function(){
          lastfly();
        });
      }
    }
  }

  $(document).on('click', '.flys__item', function(e){
    $(this).animate({opacity: 0.2}, 300, function(){
      $(this).css({"pointer-events":"none"})
      $(this).find('img').css({"transition": "5s all linear"});
      $(this).find('img').css({"transform": "rotate(360deg)"});

      $(this).animate({opacity: 0.2}, 5000, function(){
        $(this).animate({opacity: 1}, 0, function(){
          $(this).css({"pointer-events": "auto"});
          $(this).find('img').css({"transition": "0s all linear"});
          $(this).find('img').css({"transform": "rotate(0deg)"});
          if($gulps < $maxgulps){
            $gulps += 1;
            $logtext += 'gulps ' + $gulps + '\n';
            console.log('gulps ' + $gulps);
            $string = (($gulps*100)/$maxgulps) + '';
            $('.gorshok span.span span').text($string);
            $string += '%'
            $('.gorshok .after').animate({height: $string});
            if($gulps == $maxgulps){
              $logtext += 'Горшок полон \n';
              $logtext += 'Полёт к винни \n';
              console.log('Горшок полон');
              console.log('Полёт к винни');
              lastfly();
            }
          }else{
            $logtext += 'Мёд перелился \n';
            console.log('Мёд перелился');
          }
        });
      });
    });
  });
  
  function fly($a){
    $('.flys').append('<div class="flys__item">' + '<img src="https://img.icons8.com/ios/452/bee--v1.png" width="20" height="20">'+ '</div>');
    console.log('муха ' + $a);
  }

});


