$(document).ready(function () {
  var height =
    $(window).height() -
    $("#footer-wp").outerHeight(true) -
    $("#header-wp").outerHeight(true);
  $("#content").css("min-height", height);

  //  CHECK ALL
  $('input[name="checkAll"]').click(function () {
    var status = $(this).prop("checked");
    $('.list-table-wp tbody tr td input[type="checkbox"]').prop(
      "checked",
      status
    );
  });

  // EVENT SIDEBAR MENU
  $("#sidebar-menu .nav-item .nav-link .title").after(
    '<span class="fa fa-angle-right arrow"></span>'
  );
  var sidebar_menu = $("#sidebar-menu > .nav-item > .nav-link");
  sidebar_menu.on("click", function () {
    if (!$(this).parent("li").hasClass("active")) {
      $(".sub-menu").slideUp();
      $(this).parent("li").find(".sub-menu").slideDown();
      $("#sidebar-menu > .nav-item").removeClass("active");
      $(this).parent("li").addClass("active");
      return false;
    } else {
      $(".sub-menu").slideUp();
      $("#sidebar-menu > .nav-item").removeClass("active");
      return false;
    }
  });
  //   showMessage(
  //     "<h4 style='text-align: left;'>Thông báo</h4> " + "abc",
  //     "#4CAF50"
  //   );
});

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

function updateStatusSale(base_url, sale_id) {
  // Xử lý khi nhấn vào thẻ "Thêm giỏ hàng"
  $("#btn-update-status").click(function (e) {
    e.preventDefault();
    var element = document.querySelector(".status");
    var status = element.value;

    var url = base_url + "?mod=sales&controller=index&action=updateStatusSale";

    console.log(url);
    console.log(status);
    console.log(sale_id);
    // return;
    // Gửi yêu cầu Ajax để thêm sản phẩm vào giỏ hàng
    $.ajax({
      url: url,
      method: "POST",
      data: { status: status, sale_id: sale_id },
      dataType: "json",
      success: function (response) {
        // $(".sum").text(response);
        console.log(response);
        showMessage(
          "<h4 style='text-align: left;'>Thông báo</h4> " + response["message"],
          "#4CAF50"
        );
      },
      error: function (xhr, status, error) {
        // Xử lý lỗi khi yêu cầu thất bại
        console.error("Trạng thái AJAX:", status);
        console.error("Lỗi AJAX:", error);
        console.log("Dữ liệu phản hồi từ máy chủ:", xhr.responseText);
        showMessage(
          "<h4 style='text-align: left;'>Thông báo</h4> Có lỗi khi cập nhật trạng thái đơn hàng!",
          "#f12a43"
        );
      },
    });
  });
}
