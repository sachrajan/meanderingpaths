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
});

$(document).ready(function(){
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
});