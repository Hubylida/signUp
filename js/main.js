$(function () {
    'use strict';

    var $inputs = $('[data-rule]');
    var inputs = [];
    $inputs.each(function (index, node) {
        var tmp = new Input(node);
        inputs.push(tmp);
    });
    $('#log').on('submit', function (e) {
        $inputs.trigger('blur');
        for (var i = 0; i < inputs.length; i++) {
            var item = inputs[i];
            var password = $('#password').val();
            var judge = item.validator.is_valid();
            if (!judge) {
                alert('请正确输入');
                return false;
            }
        }
        $('#password').val(hex_sha1(password));
        return judge;
    });
    $('#register').on('submit', function (e) {
        $inputs.trigger('blur');
        for (var i = 0; i < inputs.length; i++) {
            var item = inputs[i];
            var password = $('#password').val(),
                password_2 = $('#password_again').val();
            var judge = item.validator.is_valid();
            // var checkCode = new checkCode();
            if (!judge) { 
                $('#checkcode').trigger('click');
                alert('请正确输入');               
                return false; 
            }
        }
        $('#password').val(hex_sha1(password));
        $('#password_again').val(hex_sha1(password_2));
        return judge;
    });
    $('#signUp').on('submit', function (e) {
        $inputs.trigger('blur');
        for (var i = 0; i < inputs.length; i++) {
            var item = inputs[i];
            var judge = item.validator.is_valid();
            if (!judge) {
                alert('请正确输入');
                return false;
            }
        }
        $('#phoneNum').val(hex_sha1(password));
        return judge;
    });
})