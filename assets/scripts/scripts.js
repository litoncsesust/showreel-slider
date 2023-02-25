var $ = jQuery.noConflict();

//Raw Js
$.fn.isOnScreen = function () {
  var win = $(window);

  var viewport = {
    top: win.scrollTop(),
    left: win.scrollLeft(),
  };
  viewport.right = viewport.left + win.width();
  viewport.bottom = viewport.top + win.height();

  var bounds = this.offset();
  bounds.right = bounds.left + this.outerWidth();
  bounds.bottom = bounds.top + this.outerHeight();

  return !(
    viewport.right < bounds.left ||
    viewport.left > bounds.right ||
    viewport.bottom < bounds.top ||
    viewport.top > bounds.bottom
  );
};

var validateEmail = function (email) {
  let res = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  return res.test(email);
};
var validateFields = function ($el, rules) {
  var validate = true;
  var keys = Object.keys(rules);
  for (let i = 0; i < keys.length; i++) {
    let rule = rules[keys[i]];
    let $current = $("[name=" + keys[i] + "]");
    let val = $current.val();
    let tempValid = true;
    if (rule.includes("required") && $.trim(val) == "") {
      $current.parent().addClass("form-field-error-required");
      tempValid = validate = false;
    }
    if (rule.includes("email") && $.trim(val) !== "" && !validateEmail(val)) {
      $current.parent().addClass("form-field-error-email");
      tempValid = validate = false;
    }
    if (tempValid) {
      $current.parent().removeClass("form-field-error-required");
      $current.parent().removeClass("form-field-error-email");
    }
  }

  return validate;
};

var animateNumber = function (el) {
  if (!el.hasClass("counted")) {
    var number = el.data("number");
    el.prop("Counter", number).animate(
      {
        Counter: el.text(),
      },
      {
        duration: 3000,
        easing: "linear",
        step: function () {
          var num = number - ~~this.Counter;
          var numWithComma = num
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          el.text(numWithComma);
        },
        complete: function () {
          var numWithComma = number
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          el.text(numWithComma);
        },
      }
    );

    el.addClass("counted");
  }
};

var slickMoveOnScroll = function (el) {
  if (el.length && el.isOnScreen()) {
    el.find(".slick-next").trigger("click");
    el.addClass("scrolled");
    setTimeout(function () {
      el.find(".slick-prev").trigger("click");
    }, 500);
  }
};

var listMoveOnScroll = function (el) {
  if (el.length && el.isOnScreen()) {
    el.animate({ scrollLeft: "+=50" }, 500);
    el.addClass("scrolled");
    setTimeout(function () {
      el.animate({ scrollLeft: "0" }, 500);
    }, 500);
  }
};

var loadMemberDetails = function (e) {
  e.preventDefault();
  let $this = $(this);
  let member_id = $this.data("member_id");
  let team_member_details = wp.template("team_member_details");
  let $member_info_details_container = $(".member-info-details-container");
  let $member_info_details_popup = $(
    ".member-info-details-popup, .member-info-details-overlay"
  );
  let form_data = new FormData();
  form_data.append("member_id", member_id);
  form_data.append("action", "load_member_details");
  $member_info_details_container.addClass("loading");
  $.ajax(echologyx_vars.ajaxUrl, {
    method: "POST",
    contentType: false,
    processData: false,
    data: form_data,
    success: function (response) {
      if (response) {
        $member_info_details_popup.addClass("active");
        $member_info_details_container.removeClass("loading");
        $member_info_details_container.html(team_member_details(response.data));
      } else {
        console.log("Fail");
      }
    },
  });
};

var submitHubSpot = function (post, hubspot, $messageContainer, $successMessageOverlay, $form){
  // Create the new request 
  var xhr = new XMLHttpRequest();
  var url = "https://api.hsforms.com/submissions/v3/integration/submit/"+hubspot.portal_id+"/"+hubspot.form_id
  
  // Example request JSON:
  var data = {
    "submittedAt": Date.now(),
    "fields": [
      {
    "objectTypeId": "0-1",
        "name": "email",
        "value": post.email
      },
      {
    "objectTypeId": "0-1",
        "name": "firstname",
        "value": post.firstname
      },
      {
      "objectTypeId": "0-1",
        "name": "lastname",
        "value": post.lastname
      },
      {
        "objectTypeId": "0-1",
          "name": "phone",
          "value": post.phone
      },
      {
      "objectTypeId": "0-1",
        "name": "company",
        "value": post.company
      },
      {
        "objectTypeId": "0-1",
          "name": "jobtitle",
          "value": post.jobtitle
      },
      {
      "objectTypeId": "0-1",
        "name": "message",
        "value": post.message
      },
      {
      "objectTypeId": "0-1",
        "name": "subscribe_for_newsletter",
        "value": post.subscribe_for_newsletter != '' ? post.subscribe_for_newsletter : ''
      }
    ],
    "context": {
      "pageUri": window.location.href,
      "pageName": document.title
    }
  }

  var final_data = JSON.stringify(data)

  xhr.open('POST', url);
  // Sets the value of the 'Content-Type' HTTP request headers to 'application/json'
  xhr.setRequestHeader('Content-Type', 'application/json');

  xhr.onreadystatechange = function() {
      if(xhr.readyState == 4 && xhr.status == 200) {
        window.location = 'https://echologyx.com/thank-you/';
      } else { 
        let response = JSON.parse(xhr.response);
        console.log(response);
        $messageContainer.addClass("form-error");
        $messageContainer.removeClass("form-success");
        $messageContainer.html(response.message);
      }
    }


  // Sends the request 
  
  xhr.send(final_data)
};

//jQuery

$(document).on("ready", function () {
  let $service_slider = $(".services-grid");
  let $window = $(window);
  let service_slider_args = {
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 6000,
    infinite: true,
    // prevArrow: null,
    // nextArrow: null,
    dots: true,
    pauseOnFocus: false,
    pauseOnHover: false,
    accessibility: false,
    focusOnSelect: false,
    pauseOnDotsHover: false,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: false,
        },
      },
    ],
  };

  var scrollInit = $(window).scrollTop();

  if (scrollInit > 10) {
    $("header").addClass("scrolled-down");
  }

  $window.on("load resize scroll", () => {
    if ($window.width() < 768) {
      $service_slider.not(".slick-initialized").slick(service_slider_args);
    } else if ($service_slider.hasClass("slick-initialized")) {
      $service_slider.slick("unslick");
    }
  });

  $(".testimonial-carosel-container").slick({
    prevArrow:
      "<button type='button' class='slick-prev pull-left'><img src='" +
      echologyx_vars.siteURI +
      "/public/img/left-arrow.png'/></button>",
    nextArrow:
      "<button type='button' class='slick-next pull-right'><img src='" +
      echologyx_vars.siteURI +
      "/public/img/right-arrow.png'/></i></button>",
    infinite: true,
    pauseOnFocus: false,
    pauseOnHover: true,
    pauseOnDotsHover: false,
    accessibility: false,
    focusOnSelect: false,
    variableWidth: true,
    cssEase: "ease-out",
  });

  // $(
  //   ".clients .testimonial-clients-quotes, .blog .testimonial-clients-quotes"
  // ).slick({
  //   prevArrow: null,
  //   nextArrow: null,
  //   slidesToShow: 1,
  //   slidesToScroll: 1,
  //   dots: true,
  //   infinite: false,
  //   pauseOnFocus: false,
  //   pauseOnHover: true,
  //   pauseOnDotsHover: false,
  //   accessibility: false,
  //   focusOnSelect: false,
  //   autoplay: true,
  // });
  $(
    ".testimonial-clients-quotes.carousel"
  ).slick({
    prevArrow:
      "<button type='button' class='slick-prev pull-left'><img src='" +
      echologyx_vars.siteURI +
      "/public/img/left-arrow.png'/></button>",
    nextArrow:
      "<button type='button' class='slick-next pull-right'><img src='" +
      echologyx_vars.siteURI +
      "/public/img/right-arrow.png'/></i></button>",
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    infinite: true,
    pauseOnFocus: false,
    pauseOnHover: true,
    pauseOnDotsHover: false,
    accessibility: false,
    focusOnSelect: false,
    autoplay: false,
    swipe: false,
    fade: true,
    autoplaySpeed: 7000
  });

  
  $(
    ".testimonial-clients-quotes.simple"
  ).slick({
    prevArrow:
      "<button type='button' class='slick-prev pull-left'><img src='" +
      echologyx_vars.siteURI +
      "/public/img/left-arrow.png'/></button>",
    nextArrow:
      "<button type='button' class='slick-next pull-right'><img src='" +
      echologyx_vars.siteURI +
      "/public/img/right-arrow.png'/></i></button>",
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    infinite: true,
    pauseOnFocus: false,
    pauseOnHover: true,
    pauseOnDotsHover: false,
    accessibility: false,
    focusOnSelect: false,
    autoplay: false,
    autoplaySpeed: 7000
  });

  $(".career-culture-gallery").slick({
    prevArrow:
      "<button type='button' class='slick-prev pull-left'><img src='" +
      echologyx_vars.siteURI +
      "/public/img/left-arrow.png'/></button>",
    nextArrow:
      "<button type='button' class='slick-next pull-right'><img src='" +
      echologyx_vars.siteURI +
      "/public/img/right-arrow.png'/></i></button>",
    infinite: true,
    pauseOnFocus: false,
    pauseOnHover: true,
    pauseOnDotsHover: false,
    accessibility: false,
    focusOnSelect: false,
    variableWidth: true,
    cssEase: "ease-out",
  });


  $('.testimonial-clients-quotes').on('afterChange', function (event, slick, currentSlide) {
    slick.$slider.parent().find('.testimonial-carosel-container .testimonial-carosel-item').removeClass('active');
    slick.$slider.parent().find('.testimonial-carosel-container .testimonial-carosel-item[data-testimonial_index=' + currentSlide + ']').addClass('active');
  });

  $("#nav-icon").on("click", function () {
    $(this).toggleClass("open");
    $(".echologxy-sitenav").toggleClass("nav-active");
  });

  $(".service-type-terms-filter").on("click", function () {
    $(".service-type-terms-filter").removeClass("active");
    $(this).addClass("active");
  });

  $(".testimonial-carosel-item").eq(1).trigger("click");
  $(".testimonial-carosel-item").on("click", function () {
    $(".testimonial-carosel-item").removeClass("active");
    $(this).addClass("active");
    var index = $(this).data('testimonial_index');
    $(".testimonial-clients-quotes .slick-dots li").eq(index).trigger("click");
  });

  if (
    $(".job-counter-container").length > 0 &&
    $(".job-counter-container").isOnScreen()
  ) {
    $("span.count-number").each(function () {
      animateNumber($(this));
    });
  }

  $(window).on("scroll wheel", function (e) {
    var scroll = $(window).scrollTop();
    var $graphicsContainer = $('.testimonial-top-graphics .graphics-container');
    if (scroll > 10) {
      $("header").addClass("scrolled-down");
      if (
        $(".job-counter-container").length > 0 &&
        $(".job-counter-container").isOnScreen()
      ) {
        $("span.count-number").each(function () {
          animateNumber($(this));
        });
      }
      slickMoveOnScroll($(".services-grid:not(.scrolled)"));
      slickMoveOnScroll($(".testimonial-carosel-container:not(.scrolled)"));
      listMoveOnScroll($(".counter-grid:not(.scrolled)"));
      listMoveOnScroll($("ul.type-filter-list:not(.scrolled)"));

      if($graphicsContainer.length && $graphicsContainer.isOnScreen()) {
        $graphicsContainer.addClass('scrolled');
      }

      $(".service-row-item:not(.scrolled) .row-icon").each(function () {
        var $this = $(this);
        if ($this.isOnScreen()) {
          setTimeout(function () {
            $this.closest(".service-row-item").addClass("scrolled");
          }, 300);
        }
      });
    } else {
      $("header").removeClass("scrolled-down");
    }
  });

  $(".service-type-terms-filter").on("click", function (e) {
    e.preventDefault();
    let term_id = $(this).data("term_id");
    let client_brand_logo_items = wp.template("client_brand_logo_items");
    let form_data = new FormData();
    let $logo_item_container = $(".client-brands-logo-cotainers");
    form_data.append("term_id", term_id);
    form_data.append("action", "filter_client_by_service");
    $logo_item_container.addClass("loading");
    $.ajax(echologyx_vars.ajaxUrl, {
      method: "POST",
      contentType: false,
      processData: false,
      data: form_data,
      success: function (response) {
        if (response) {
          $logo_item_container.html(client_brand_logo_items(response));
          $logo_item_container.removeClass("loading");
          $(".client-brand-logo-item.new-load").each(function (i) {
            setTimeout(function () {
              $(".client-brand-logo-item.new-load")
                .eq(i)
                .addClass("new-loaded");
            }, 50 * i);
          });
        } else {
          console.log("Fail");
        }
      },
    });
  });

  $(".blog-category-filter-list .category-item").on("click touchstart", function (e) {
    e.preventDefault();
    let term_id = $(this).data("term_id");
    let $this = $(this);
    let $parent = $this.parent();
    let $load_more_button = $(".load-more-button");
    $load_more_button.data("term_id", term_id);
    let page = parseInt($this.data("page"));
    let type = $this.data("type");
    let taxonomy = $this.data("taxonomy");
    let numberofpost = $this.data("numberofpost");
    let offset = page * numberofpost;
    let post_grid_items = wp.template("post_grid_items");
    let form_data = new FormData();
    let $post_grid = $(".post-grid");
    form_data.append("offset", offset);
    form_data.append("type", type);
    form_data.append("taxonomy", taxonomy);
    form_data.append("term_id", term_id);
    form_data.append("numberofpost", numberofpost);
    form_data.append("action", "load_more_posts");
    $(".blog-category-filter-list .category-item").removeClass("active");
    $(".post-grid-item").removeClass("new-loaded");
    $parent.addClass('loading-bar');
    $.ajax(echologyx_vars.ajaxUrl, {
      method: "POST",
      contentType: false,
      processData: false,
      data: form_data,
      success: function (response) {
        if (response) {
          $parent.addClass('loaded-bar');
          $post_grid.html(post_grid_items(response));
          $load_more_button.data("count", response.count);
          $load_more_button.data("page", 1);
          $this.addClass("active");
          setTimeout(function () {
            $(".post-grid-item.new-load").addClass("new-loaded");
            $(".post-grid-item").removeClass("new-load");
            $parent.removeClass('loaded-bar');
            $parent.removeClass('loading-bar');
            if ($(".post-grid-item.new-loaded").length) {
              $("html, body").animate(
                {
                  scrollTop:
                    $(".post-grid-item.new-loaded").eq(0).offset().top - 260,
                },
                500
              );
            }

            if (response.count >= response.found) {
              $load_more_button.hide();
            } else {
              $load_more_button.show();
            }
            $load_more_button.text("Load More");
          }, 100);
        } else {
          console.log("Fail");
        }
      },
    });
  });

  $(".load-more-button").on("click", function (e) {
    e.preventDefault();
    let $this = $(this);
    let count = parseInt($this.data("count"));
    let page = parseInt($this.data("page"));
    let type = $this.data("type");
    let term_id = $this.data("term_id");
    let taxonomy = $this.data("taxonomy");
    let numberofpost = $this.data("numberofpost");
    let offset = page * numberofpost;
    let post_grid_items = wp.template("post_grid_items");
    let form_data = new FormData();
    let $team_grid = $(".post-grid");
    form_data.append("offset", offset);
    form_data.append("type", type);
    form_data.append("taxonomy", taxonomy);
    form_data.append("term_id", term_id);
    form_data.append("numberofpost", numberofpost);
    form_data.append("action", "load_more_posts");
    $this.text("Loading...");
    $(".post-grid-item").removeClass("new-loaded");
    $.ajax(echologyx_vars.ajaxUrl, {
      method: "POST",
      contentType: false,
      processData: false,
      data: form_data,
      success: function (response) {
        if (response) {
          $this.data("page", page + 1);
          let currentCount = count + response.count;
          $this.data("count", currentCount);
          $team_grid.append(post_grid_items(response));
          if ($(".team-grid-item").length) {
            $(".team-grid-item").on("click", loadMemberDetails);
          }
          setTimeout(function () {
            $(".post-grid-item.new-load").addClass("new-loaded");
            $(".post-grid-item").removeClass("new-load");
            // if ($(".post-grid-item.new-loaded").length) {
            //   if (currentCount < response.found) {
            //     $("html, body").animate(
            //       {
            //         scrollTop:
            //           $(".post-grid-item.new-loaded").eq(0).offset().top - 250,
            //       },
            //       1000
            //     );
            //   }
            // }
            if (currentCount >= response.found) {
              $this.hide();
            }
            $this.text("Load More");
          }, 100);
        } else {
          console.log("Fail");
        }
      },
    });
  });

  // $(".post-grid").on("wheel", function (e) {
  //   if (!$(".post-grid-item.new-loaded").length || e.originalEvent.deltaY < 0)
  //     return;
  //   $(".load-more-button").trigger("click");
  // });

  $(".write-to-us-form").on("submit", function (e) {
    e.preventDefault();
    var $form = $(this);
    var data = $form.serialize();
    var $formContainer = $(".write-to-us-form-container");
    var $messageContainer = $(".write-to-us-submission-message");
    var $successMessageOverlay = $(".contact-success-message-overlay");
    if (
      validateFields($form, {
        name: "required",
        email: "required|email",
        message: "required",
        jobtitle: "required",
        company: "required",
      })
    ) {

      $formContainer.addClass("loading");
      $.ajax(echologyx_vars.ajaxUrl, {
        method: "POST",
        data: data,
        success: function (response) {
          $formContainer.removeClass("loading");
          if (response.error == false) {
            if( response.hubspot.portal_id != '' ) {
            	window.location = 'https://echologyx.com/thank-you/';
            } else  {
              $form.addClass('disabled');
              $successMessageOverlay.addClass("active");
              $messageContainer.removeClass("form-error");
              $messageContainer.html(response.message);
            }
          } else {
            $messageContainer.addClass("form-error");
            $messageContainer.html(response.message);
          }
        },
      });
    }
  });

  $(".write-to-us-form input, .write-to-us-form textarea").on(
    "change",
    function (e) {
      e.preventDefault();
      validateFields($(this), {
        name: "required",
        email: "required|email",
        message: "required",
        jobtitle: "required",
        company: "required",
      });
    }
  );

  $(".team-grid-item").on("click", loadMemberDetails);
  $(".member-details-popup-closed").on("click", function (e) {
    $(".member-info-details-popup, .member-info-details-overlay").removeClass(
      "active"
    );
  });

  $(document).on("click", function(e) {
    if (!$(e.target).closest(".member-info-details-popup").length) {
      $(".member-info-details-popup, .member-info-details-overlay").removeClass("active");
    }

    if (!$(e.target).hasClass('apply-job-popup') && !$(e.target).closest(".apply-job-modal-container").length) {
      $(".apply-job-modal-container, .apply-job-form-modal-overlay").removeClass("active");
    }

    if ( $(e.target).hasClass('close-icon') || $(e.target).parent().hasClass('close-icon') ) {
      $(".apply-job-modal-container, .apply-job-form-modal-overlay").removeClass("active");
    }

  });


  $(".apply-job-popup").on("click", function (e) {
    $(".apply-job-modal-container, .apply-job-form-modal-overlay").addClass("active");
  });

  
  $(".contact-form-message-close").on("click", function (e) {
    $('.cantact-form').hide();
    $(".contact-success-message-overlay").removeClass('active');
  });

  $(".link-prevent-default").on("click", function (e) {
    e.preventDefault();
  });
});
