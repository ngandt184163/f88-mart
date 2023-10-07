$(document).ready(function () {
  //  SLIDER
  var slider = $("#slider-wp .section-detail");
  slider.owlCarousel({
    autoPlay: 4500,
    navigation: false,
    navigationText: false,
    paginationNumbers: false,
    pagination: true,
    items: 1, //10 items above 1000px browser width
    itemsDesktop: [1000, 1], //5 items between 1000px and 901px
    itemsDesktopSmall: [900, 1], // betweem 900px and 601px
    itemsTablet: [600, 1], //2 items between 600 and 0
    itemsMobile: true, // itemsMobile disabled - inherit from itemsTablet option
  });

  //  ZOOM PRODUCT DETAIL
  $("#zoom").elevateZoom({
    gallery: "list-thumb",
    cursor: "pointer",
    galleryActiveClass: "active",
    imageCrossfade: true,
    loadingIcon: "http://www.elevateweb.co.uk/spinner.gif",
  });

  //  LIST THUMB
  var list_thumb = $("#list-thumb");
  list_thumb.owlCarousel({
    navigation: true,
    navigationText: false,
    paginationNumbers: false,
    pagination: false,
    stopOnHover: true,
    items: 5, //10 items above 1000px browser width
    itemsDesktop: [1000, 5], //5 items between 1000px and 901px
    itemsDesktopSmall: [900, 5], // betweem 900px and 601px
    itemsTablet: [768, 5], //2 items between 600 and 0
    itemsMobile: true, // itemsMobile disabled - inherit from itemsTablet option
  });

  //  FEATURE PRODUCT
  var feature_product = $("#feature-product-wp .list-item");
  feature_product.owlCarousel({
    autoPlay: true,
    navigation: true,
    navigationText: false,
    paginationNumbers: false,
    pagination: false,
    stopOnHover: true,
    items: 4, //10 items above 1000px browser width
    itemsDesktop: [1000, 4], //5 items between 1000px and 901px
    itemsDesktopSmall: [800, 3], // betweem 900px and 601px
    itemsTablet: [600, 2], //2 items between 600 and 0
    itemsMobile: [375, 1], // itemsMobile disabled - inherit from itemsTablet option
  });

  //  SAME CATEGORY
  var same_category = $("#same-category-wp .list-item");
  same_category.owlCarousel({
    autoPlay: true,
    navigation: true,
    navigationText: false,
    paginationNumbers: false,
    pagination: false,
    stopOnHover: true,
    items: 4, //10 items above 1000px browser width
    itemsDesktop: [1000, 4], //5 items between 1000px and 901px
    itemsDesktopSmall: [800, 3], // betweem 900px and 601px
    itemsTablet: [600, 2], //2 items between 600 and 0
    itemsMobile: [375, 1], // itemsMobile disabled - inherit from itemsTablet option
  });

  //  SCROLL TOP
  $(window).scroll(function () {
    if ($(this).scrollTop() != 0) {
      $("#btn-top").stop().fadeIn(150);
    } else {
      $("#btn-top").stop().fadeOut(150);
    }
  });
  $("#btn-top").click(function () {
    $("body,html").stop().animate({ scrollTop: 0 }, 800);
  });

  // CHOOSE NUMBER ORDER
  // var value = parseInt($("#num-order").attr("value"));
  // $("#plus").click(function () {
  //   value++;
  //   $("#num-order").attr("value", value);
  //   // update_href(value);
  // });
  // $("#minus").click(function () {
  //   if (value > 1) {
  //     value--;
  //     $("#num-order").attr("value", value);
  //   }
  //   // update_href(value);
  // });

  $(".plus").click(function () {
    var input = $(this).prev("input");
    var value = parseInt(input.val());
    value++;
    input.attr("value", value);
  });
  $(".minus").click(function () {
    var input = $(this).next("input");
    var value = parseInt(input.val());
    if (value > 1) {
      value--;
      input.attr("value", value);
    }
  });

  //  MAIN MENU
  $("#category-product-wp .list-item > li")
    .find(".sub-menu")
    .after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');

  //  TAB
  tab();

  //  EVEN MENU RESPON
  $("html").on("click", function (event) {
    var target = $(event.target);
    var site = $("#site");

    if (target.is("#btn-respon i")) {
      if (!site.hasClass("show-respon-menu")) {
        site.addClass("show-respon-menu");
      } else {
        site.removeClass("show-respon-menu");
      }
    } else {
      $("#container").click(function () {
        if (site.hasClass("show-respon-menu")) {
          site.removeClass("show-respon-menu");
          return false;
        }
      });
    }
  });

  //  MENU RESPON
  $("#main-menu-respon li .sub-menu").after(
    '<span class="fa fa-angle-right arrow"></span>'
  );
  $("#main-menu-respon li .arrow").click(function () {
    if ($(this).parent("li").hasClass("open")) {
      $(this).parent("li").removeClass("open");
    } else {
      //            $('.sub-menu').slideUp();
      //            $('#main-menu-respon li').removeClass('open');
      $(this).parent("li").addClass("open");
      //            $(this).parent('li').find('.sub-menu').slideDown();
    }
  });

  // SIDEBAR
  // Lấy tất cả các thẻ ul có class="sub-menu"
  var subMenus = document.querySelectorAll("ul.sub-menu");
  // console.log(subMenus);
  // Kiểm tra và thêm thuộc tính "hidden" cho các thẻ ul không có thẻ con
  subMenus.forEach(function (subMenu) {
    if (subMenu.childElementCount === 0) {
      // subMenu.setAttribute("hidden", "true");
      subMenu.style.display = "none";
      subMenu.classList.remove("sub-menu");
      // subMenu.classList.add("hidden");
    }
  });

  //  CHECK ALL
  $('input[name="checkAll"]').click(function () {
    var status = $(this).prop("checked");
    $('.list-table-wp tbody tr td input[type="checkbox"]').prop(
      "checked",
      status
    );
  });

  // test
  $("#test").click(function (e) {
    e.preventDefault();
    showMessage(
      "<h4 style='text-align: left;'>Thông báo</h4> Thêm sản phẩm thành công!",
      "#4CAF50"
    );
  });
});

function tab() {
  var tab_menu = $("#tab-menu li");
  tab_menu.stop().click(function () {
    $("#tab-menu li").removeClass("show");
    $(this).addClass("show");
    var id = $(this).find("a").attr("href");
    $(".tabItem").hide();
    $(id).show();
    return false;
  });
  $("#tab-menu li:first-child").addClass("show");
  $(".tabItem:first-child").show();
}

function currency_format(number, suffix = "đ") {
  // Sử dụng hàm toLocaleString() để định dạng số tiền theo ngôn ngữ và quốc gia của trình duyệt
  return (
    number.toLocaleString("vi-VN", { style: "currency", currency: "VND" }) +
    suffix
  );
}

console.log(currency_format(8000000));

function addCart(base_url, is_login, url_login) {
  // Xử lý khi nhấn vào thẻ "Thêm giỏ hàng"
  $(".add-cart").click(function (e) {
    e.preventDefault();
    // neu chua login thi chuyen den trang login
    if (!is_login) {
      window.location.href = url_login;
    }

    var numOrder = 1; // Mặc định là 1 nếu không có thẻ input

    // Kiểm tra xem có phần tử input[name="num-order"] trong trang
    var numOrderInput = document.querySelector('input[name="num-order"]');

    if (numOrderInput) {
      // Nếu tồn tại phần tử input, lấy giá trị của nó và chuyển sang kiểu số nguyên
      numOrder = parseInt(numOrderInput.value, 10);
    }
    var productId = $(this).data("product-id");
    var url = base_url + "?mod=cart&controller=index&action=addCart";

    console.log(url);
    console.log(productId);
    console.log(numOrder);
    // return;
    // Gửi yêu cầu Ajax để thêm sản phẩm vào giỏ hàng
    $.ajax({
      url: url,
      method: "POST",
      data: { product_id: productId, quantity: numOrder },
      dataType: "json",
      success: function (response) {
        // $(".sum").text(response);
        console.log(response);
        showMessage(
          "<h4 style='text-align: left;'>Thông báo</h4> " + response["message"],
          "#4CAF50"
        );
        // cập nhật giao diện
        if (response["success"]) {
          $html =
            "Có <span>" +
            response["cart"]["total"] +
            " sản phẩm</span> trong giỏ hàng";
          $("#total-in-cart").html($html);

          $("#num").text(response["cart"]["total"]);

          // cập nhật danh sách trong giỏ hàng
          // Xóa tất cả các sản phẩm hiện có trong danh sách đơn hàng
          $("#order-list").empty();

          // Lặp qua danh sách đơn hàng mới và thêm từng sản phẩm vào danh sách
          $.each(response["list_orders"], function (index, order) {
            var price = currency_format(order["price"]);
            var total_price = currency_format(response["cart"]["total_price"]);
            var item =
              '<li class="clearfix">' +
              '<a href="link-to-product" title="Product Title" class="thumb fl-left">' +
              '<img src="/images/' +
              order["image"] +
              ' " alt="Product Image">' +
              "</a>" +
              '<div class="info fl-right">' +
              '<a href="link-to-product" title="' +
              order["name"] +
              '" class="product-name">' +
              order["name"] +
              "</a>" +
              '<p class="price">' +
              price +
              "</p>" +
              '<p class="qty">Số lượng: <span>' +
              order["total"] +
              "</span></p>" +
              "</div>" +
              "</li>";
            $("#order-list").append(item);

            $("#total-payment").text(total_price);
          });
        }
      },
      error: function (xhr, status, error) {
        // Xử lý lỗi khi yêu cầu thất bại
        console.error("Trạng thái AJAX:", status);
        console.error("Lỗi AJAX:", error);
        console.log("Dữ liệu phản hồi từ máy chủ:", xhr.responseText);
        showMessage(
          "<h4 style='text-align: left;'>Thông báo</h4> Có lỗi khi thêm vào giỏ hàng!",
          "#f12a43"
        );
      },
    });
  });
}

function showMessage(message, backgroundColor) {
  var statusMessage = document.getElementById("status-message");
  statusMessage.innerHTML = message;
  statusMessage.style.backgroundColor = backgroundColor;
  statusMessage.classList.remove("hidden"); // Loại bỏ lớp "hidden" để hiển thị
  statusMessage.classList.add("visible"); // Thêm lớp "visible" để nổi lên

  // Tự động ẩn thông báo sau một khoảng thời gian (ví dụ: 3 giây)
  setTimeout(function () {
    statusMessage.classList.remove("visible"); // Loại bỏ lớp "visible" để ẩn
    statusMessage.classList.add("hidden"); // Thêm lớp "hidden" để ẩn
  }, 3000); // 3 giây
}

function checkStatusUpdateInfoUser(statusUpdateInfoUser) {
  console.log(statusUpdateInfoUser);
  if (statusUpdateInfoUser == 1) {
    showMessage(
      "<h4 style='text-align: left;'>Thông báo</h4> Cập nhật thông tin thành công!",
      "#4CAF50"
    );
  } else {
    showMessage(
      "<h4 style='text-align: left;'>Thông báo</h4> Cập nhật thông tin thất bại!",
      "#f12a43"
    );
  }
}

function checkStatusUpdatePassword(statusUpdatePassword) {
  if (statusUpdatePassword == 1) {
    showMessage(
      "<h4 style='text-align: left;'>Thông báo</h4> Cập nhật mật khẩu thành công!",
      "#4CAF50"
    );
  } else {
    showMessage(
      "<h4 style='text-align: left;'>Thông báo</h4> Cập nhật mật khẩu thất bại!",
      "#f12a43"
    );
  }
}
