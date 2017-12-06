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
        $(".post-image1").show();
        $(".post-image2").hide();
        $(".post-image3").hide();
        $(".post-image4").hide();
        $(".carousel-content2").hide();
        $(".carousel-content3").hide();
        $(".carousel-content4").hide();
    });
    $("#car-img-2").click(function(){
        console.log("heer");
        $(".carousel-content2").show();
        $(".post-image2").show();
        $(".post-image1").hide();
        $(".post-image3").hide();
        $(".post-image4").hide();
        $(".carousel-content1").hide();
        $(".carousel-content3").hide();
        $(".carousel-content4").hide();
    });
    $("#car-img-3").click(function(){
        $(".carousel-content3").show();
        $(".post-image3").show();
        $(".post-image2").hide();
        $(".post-image1").hide();
        $(".post-image4").hide();
        $(".carousel-content2").hide();
        $(".carousel-content1").hide();
        $(".carousel-content4").hide();
    });
     $("#car-img-4").click(function(){
        $(".carousel-content4").show();
        $(".post-image4").show();
        $(".post-image2").hide();
        $(".post-image1").hide();
        $(".post-image3").hide();
        $(".carousel-content2").hide();
        $(".carousel-content1").hide();
        $(".carousel-content3").hide();
    });
});


// /*jquery navbar*/
// var x = $(".navbar").position().top;

// if (x = 0) {
//     $(".navbar").css("position", "fixed");
// }else{
//     $(".navbar").css("position", "relative");
// };