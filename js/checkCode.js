$(function () {
    'ues strict';

    window.CheckCode = function () {
        this.code = "";
        this.createCode = function () {
            var codelength = 4;
            var array = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E',
                'F', 'G', 'H',
                'I', 'J',
                'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
                'Y', 'Z');
            for (var i = 0; i < codelength; i++) {
                var item = Math.floor(Math.random() * 36);
                this.code = this.code + array[item];
            }
            $('#checkcode').text(this.code);
            return this.code;
        }
        this.renew = function () {
            $('#checkinput').val('');
            this.code = '';
            this.createCode();
        }
        this.click = function () {
            this.renew();
        }
        return this.code;
    }
})