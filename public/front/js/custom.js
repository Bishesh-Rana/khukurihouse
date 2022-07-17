jQuery(document).ready(function($) {


// Mobile Nav
$("#menu1").metisMenu();
    // MObile Nav End

    // Side menubar
    $("#close-btn, .toggle-btn").click(function() {
      $("#mySidenav, body").toggleClass("active");
  });
    // Mobile Nav End


    // Dropdown
    $(".navbar-nav li, .navigations li").hover(function() {
        var isHovered = $(this).is(":hover");
        if (isHovered) {
            $(this).children("ul").stop().slideDown(300);
        } else {
            $(this).children("ul").stop().slideUp(300);
        }
    });
    // Dropdown End

    // Carousal
    $('.carousel').carousel({
        interval: false,
    })
        // Carousal End


    // Product
    $('.product').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            700: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
        // Product End


    // Product
    $('.review').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
        // Product End



        // Thumbnail Slider
        $('#slide').lightSlider({
            gallery:true,
            item:1,
            thumbItem:6,
            slideMargin: 0,
            thumbMargin: 10,
            speed:500,
            auto:true,
            loop:true,
            keyPress: true,
            controls: true,
            enableTouch:true,
            prevHtml: '<i class="fas fa-angle-left"></i>',
            nextHtml: '<i class="fas fa-angle-right"></i>',
            responsive : [
            {
                breakpoint:575,
                settings: {
                    thumbItem:4
                }
            }
            ],
            onSliderLoad: function() {
                $('#slide').removeClass('cS-hidden');
            }  
        });
    // Thumbnail Slider End



    // Accordian
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
      $(e.target)
      .prev()
      .find("i:last-child")
      .toggleClass("las la-minus las la-plus");
  });
    // Accordian End

});