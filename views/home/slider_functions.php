<script>

function loadSlider(id){
	switch(id) {
	  case "box-3":
	    cSlider(id);
	    break;
	  case "box-5":
	    dvTeam(id);
	    break;
	  case "box-6":
	    dvLogos(id);
	    break;
	  default:
	    // code block
	}
}

function cSlider(id){
	$("#"+id+" .cSlider .owl-carousel").owlCarousel({
        loop: true,// true means will not stop at last image
        margin: 0,
        //lazyLoad: true,
        responsiveClass: true,
        navSpeed: 1000,
        navClass: false,
        items: 1,
        autoplay: false,
        autoplayTimeout: 5000,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 1,
            }
        }
    });
}

function dvTeam(id){
	$("#"+id+" .dvTeam .owl-carousel").owlCarousel({
        loop: true,
        margin: 15,
        responsiveClass: true,
        navSpeed: 1000,
        navClass: false,
        items: 1,
        autoplay: false,
        // autoplayTimeout: 5000,
        // autoplaySpeed:1200,
        dots: true,
        responsive: {
            0: {
                items: 3
                // nav: true
            },
            576: {
                items: 3
                // nav: true
            },
            768: {
                items: 3,
                // nav: true,
                loop: false
            }
        }
    });
}

function dvLogos(id){
	$("#"+id+" .dvLogos .owl-carousel").owlCarousel({
        loop: true,
        margin: 15,
        responsiveClass: true,
        navSpeed: 1000,
        navClass: false,
        items: 1,
        autoplay: true,
        autoplayTimeout: 5000,
        // autoplaySpeed:1200,
        dots: false,
        responsive: {
            0: {
                items: 1
                // nav: true
            },
            992: {
                items: 3,
                // nav: true,
                loop: false
            }
        }
    });
}

</script>