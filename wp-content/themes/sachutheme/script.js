$(document).ready(function(){
    $(".feature-list-india").mouseover(function(){
        $(".menu-india").show();
        $(".menu-canada").hide();
        $(".menu-travel").hide();
    });
    $(".feature-list-canada").mouseover(function(){
        $(".menu-india").hide();
        $(".menu-canada").show();
        $(".menu-travel").hide();
    });
    $(".feature-list-travel").mouseover(function(){
        $(".menu-india").hide();
        $(".menu-canada").hide();
        $(".menu-travel").show();
    });

    $("#car-img-1").click(function(){
        $(".carousel-content1").show();
        document.querySelector(".active").classList.remove("active");
        document.getElementById('elem1').className += ' active';
        $(".carousel-content2").hide();
        $(".carousel-content3").hide();
    });
    $("#car-img-2").click(function(){
        $(".carousel-content2").show();
        document.querySelector(".active").classList.remove("active");
        document.getElementById('elem2').className += ' active';
        $(".carousel-content1").hide();
        $(".carousel-content3").hide();
    });
    $("#car-img-3").click(function(){
        $(".carousel-content3").show();
        document.querySelector(".active").classList.remove("active");
        document.getElementById('elem3').className += ' active';
        $(".carousel-content2").hide();
        $(".carousel-content1").hide();
    });

    // Instantiate the Bootstrap carousel
    $('.multi-item-carousel').carousel({
      interval: false
    });

    // for every slide in carousel, copy the next slide's item in the slide.
    // Do the same for the next, next item.
    $('.multi-item-carousel .item').each(function(){
      var next = $(this).next();
      if (!next.length) {
        next = $(this).siblings(':first');
      }
      next.children(':first-child').clone().appendTo($(this));
      
      if (next.next().length>0) {
        next.next().children(':first-child').clone().appendTo($(this));
      } else {
        $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
      }
    });
});