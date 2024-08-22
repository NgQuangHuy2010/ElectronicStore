$(document).ready(function () {
    $('#province').change(function () {
        var selectedProvince = $(this).val();
        $('#selected_province').val(selectedProvince); // Cập nhật giá trị cho input hidden
        $('#district').html('<option value="">--Chọn quận/huyện--</option>');
        $('#ward').html('<option value="">--Chọn phường/xã--</option>');

        $.each(locations, function (key, value) {
            if (value.name === selectedProvince) {
                $.each(value.districts, function (key, district) {
                    $('#district').append('<option value="' + district.name + '">' + district.name + '</option>');
                });
            }
        });
    });

    $('#district').change(function () {
        var selectedDistrict = $(this).val();
        $('#selected_district').val(selectedDistrict); // Cập nhật giá trị cho input hidden
        $('#ward').html('<option value="">--Chọn phường/xã--</option>');

        $.each(locations, function (key, value) {
            $.each(value.districts, function (key, district) {
                if (district.name === selectedDistrict) {
                    $.each(district.wards, function (key, ward) {
                        $('#ward').append('<option value="' + ward.name + '">' + ward.name + '</option>');
                    });
                }
            });
        });
    });

    $('#ward').change(function () {
        var selectedWard = $(this).val();
        $('#selected_ward').val(selectedWard); // Cập nhật giá trị cho input hidden
    });

    // Xử lý khi submit form
    $('#shipment-form').submit(function (event) {
        event.preventDefault(); // Ngăn chặn submit tự động

        // Khởi tạo mảng để lưu trữ giá trị được chọn
        var selectedLocations = {
            province: $('#province').val(),
            district: $('#district').val(),
            ward: $('#ward').val()
        };

        // Chuyển đổi mảng thành chuỗi JSON
        var selectedLocationsJson = JSON.stringify(selectedLocations);

        // Tạo hoặc cập nhật một input ẩn trong form để lưu trữ chuỗi JSON
        if ($('#selected_locations').length === 0) {
            $('<input>').attr({
                type: 'hidden',
                id: 'selected_locations',
                name: 'selected_locations',
                value: selectedLocationsJson
            }).appendTo('#shipment-form');
        } else {
            $('#selected_locations').val(selectedLocationsJson);
        }

        // Sau khi lưu xong, submit form
        this.submit();
    });
});
