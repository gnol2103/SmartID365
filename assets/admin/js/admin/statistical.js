$(document).ready(function () {
    $('.search').click(function () {
        var date_from = $('.date_from').val();
        var date_to = $('.date_to').val();
        $.ajax({
            url: "/Admin/Handles/Statis/search",
            type: "POST",
            dataType: "JSON",
            data: {
                date_from: date_from,
                date_to: date_to,
            },
            success: function (response) {
                check = response.result;
                data = response.data;
                htmlSearch = '';
                voucher = ''
                if (check == true) {
                    $.each(data, function (index, value) {
                        if (value.voucher == '') {
                            voucher = 'x';
                        } else {
                            voucher = value.voucher;
                        }
                        htmlSearch += `<tr>
                                <td>`+ value.id + `</td>
                                <td>`+ value.user_id + `</td>
                                <td>`+ voucher + `</td>
                                <td>`+ value.bill_name + `</td>
                                <td>`+ value.phone + `</td>
                                <td>`+ value.address + `</td>
                                <td>`+ value.card_name + `</td>
                                <td>`+ value.note + `</td>
                                <td>`+ value.total_trans + `</td>
                                <td>`+ date('Y-m-d', value.created_at) + `</td>
                                <td>`+ value.total_price.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + `</td>
                                <td class="d-flex justify-content-center">
                                    <a href="/admin/approved_details?id=<?= $value['id'] ?>" class="btn btn-primary">Chi tiết</a>
                                </td>
                            </tr>`;
                        $('.dataSearch').html(htmlSearch);
                    });
                } else {
                    alert(response.message);
                }
            },
        });
        return false;
    })
})