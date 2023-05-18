$(document).ready(function () {
    $("#searchProducts").keyup(function () {
        var name = $(this).val();
        var _token = $('meta[name="csrf-token"]').attr("content");

        if (name.length > 0) {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    name: name,
                    _token: _token,
                },
                success: function (response) {
                  var dataList = $("#products");
                  dataList.empty();
  
                  $.each(response, function (index, product) {
                      var option = $("<option>")
                          .val(product.name)
                          .attr("data-value", product.id)
                          .attr("data-price", product.price)
                          .text("Giá: $" + product.price);
  
                      dataList.append(option);
                  });
              },
          });
      } else {
          $("#products").empty();
      }
    });

    $(document).on("click", ".product", function () {
        var productName = $(this).text();
        $("#searchProducts").val(productName);
        $("#productList").empty();
    });

    $("#btn-add").click(function (e) {
        const searchValue = $("#searchProducts").val(); //lấy giá trị ô tìm kiếm
        const matchedOption = $(
            "#products option[value='" + searchValue + "']"
        ); //tìm kiếm phần tử tương ứng trong datalist
        if (matchedOption.length > 0) {
            //nếu có thì chuỗi có độ dài lớn hơn 0
            const optionprice = matchedOption.data("price");
            const optionval = matchedOption.val();
            const optionid = matchedOption.data("value");
            var check = true;
            $(".product-id").each(function () {
                if ($(this).text() == optionid) {
                    let quantity = $(".quantity-input").filter(function () {
                        return $(this).data("product-id") === optionid;
                    });

                    let oldVal = parseInt(quantity.val());
                    quantity.val(oldVal + 1);
                    check = false;
                }
            });
            if (check) {
                var row = $("#order-items tr").length + 1;
                var product = "<tr>";
                var quanlity = `<button type="button" class="btn quantity-btn quantity-decrement" data-product-id="${optionid}">-</button>
        <input type="number" name='quantity[]' style="max-width:5rem" class="form-control quantity-input" value="1" min="1" max="1000" data-product-id="${optionid}">
        <button type="button" class="btn quantity-btn quantity-increment" data-product-id="${optionid}">+</button>`;
                product +=
                    '<td class="product-id d-none"><input type="hidden" name="product-id[]" value="' +
                    optionid +
                    '">' +
                    optionid +
                    "</td>";
                product += '<td class="">' + row + "</td>";
                product += "<td>" + optionval + "</td>";
                product += `<td class="product-price" data-product-id="${optionid}"><input type="hidden" name="price[]" value="${optionprice}"> ${optionprice}  </td>`;
                product +=
                    "<td class='d-flex justify-content-center'>" +
                    quanlity +
                    "</td>";
                product += `<td class='total-price' data-product-id="${optionid}"> ${optionprice} </td>`;
                product +=
                    "<td><button type='button' class='btn btn-danger btn-cancel'>Hủy</button></td>";
                product += "</tr>";
                $("#order-items").append(product);
                total();
            }
            updateTotal(optionid);
            $("#searchProducts").val("");
        } else {
            $("#result").html("Không tìm thấy sản phẩm phù hợp");
        }
    });
    //button quantily
    $(document).on("click", ".quantity-btn", function (e) {
        var product_id = $(this).data("product-id");
        var input = $(".quantity-input").filter(function () {
            return $(this).data("product-id") === product_id;
        });

        var oldVal = parseInt(input.val());
        var newVal;
        newVal = $(this).hasClass("quantity-decrement") ? oldVal - 1 : newVal;
        newVal = newVal <= 0 ? 1 : newVal;
        newVal = $(this).hasClass("quantity-increment") ? oldVal + 1 : newVal;
        newVal = newVal >= 1000 ? 1000 : newVal;
        input.val(newVal);
        updateTotal(product_id);
    });

    $(document).on("click", ".btn-cancel", function (e) {
        // Tìm thẻ <tr> cha gần nhất của nút xóa
        var row = $(this).closest("tr");
        row.remove();
        total();
    });

    $(document).on("input change", ".quantity-input", function (e) {
        if ($(this).val() == "" || $(this).val() < 0) {
            $(this).val(1);
        }
        if ($(this).val() > 1000) {
            $(this).val(1000);
        }
        let id = $(this).data("product-id");
        updateTotal(id);
        total();
    });
});
function total() {
    $("#total-price").val(0);

    $(".total-price").each(function () {
        let price = parseFloat($(this).text());
        let total = parseFloat($("#total-price").val());
        $("#total-price").val(total + price);
    });
}
function updateTotal(productId) {
    //tính tổng tiền từng sản phẩm
    let quantityCell = $(".quantity-input").filter(function () {
        return $(this).data("product-id") === productId;
    });
    let quantity = parseInt(quantityCell.val());

    let priceCell = $(".product-price").filter(function () {
        return $(this).data("product-id") === productId;
    });
    let price = parseFloat(priceCell.text());

    let totalCell = $(".total-price").filter(function () {
        return $(this).data("product-id") === productId;
    });
    let newTotal = parseFloat(quantity * price).toFixed(2);
    totalCell.text(newTotal);
    total();
}
///
