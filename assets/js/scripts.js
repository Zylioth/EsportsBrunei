$(document).ready(function () {
    $(".menu-toggle").on("click", function () {
        $(".nav").toggleClass("showing");
        $(".nav ul").toggleClass("showing");
    });

    $(".post-wrapper").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        fade: true,
        nextArrow: $(".next"),
        prevArrow: $(".prev"),
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
});

ClassicEditor.create(document.querySelector("#body"), {
    toolbar: [
        "heading",
        "|",
        "bold",
        "italic",
        "link",
        "bulletedList",
        "numberedList",
        "blockQuote"
    ],
    heading: {
        options: [
            { model: "paragraph", title: "Paragraph", class: "ck-heading_paragraph" },
            {
                model: "heading1",
                view: "h1",
                title: "Heading 1",
                class: "ck-heading_heading1"
            },
            {
                model: "heading2",
                view: "h2",
                title: "Heading 2",
                class: "ck-heading_heading2"
            }
        ]
    }
}).catch(error => {
    console.log(error);
});

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  /* Set the width of the side navigation to 0 */
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

// function triggerClick(e) {
//     document.querySelector('#profileImage').click();
//   }
//   function displayImage(e) {
//     if (e.files[0]) {
//       var reader = new FileReader();
//       reader.onload = function(e){
//         document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
//       }
//       reader.readAsDataURL(e.files[0]);
//     }
//   }
//   ;

  
