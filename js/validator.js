$(function () {
    'use strict';



    //作为全局变量传出去
    window.Validator = function (val, rule) {

        this.is_valid = function (new_val) {
            var key;
            //input里什么都不输的时候,其值不是undefined而是空字符串''.
            if (new_val === '') {
                val = '';
            } else {
                val = new_val || val; //当提交表单时,不再取一次值,因此new_val的值位undefined
            }

            //如果不是必填项就不必进行验证
            if (!rule.required && !val) {
                return false;
            }

            for (key in rule) {
                //防止重复检查
                if (key === 'required') {
                    continue;
                }
                //调用rule中相应的方法
                var r = this['validate_' + key]();
                if (!r) {
                    return false;
                }
            }

            return true;
        }
        this.validate_check = function () {
            var test = $('#checkinput');
            if (test.val() === "") {
                return false;
            } else {
                return true;
            }
        }
        this.validate_max = function () {
            pre_max_min();
            return val <= rule.max;
        }

        this.validate_min = function () {
            pre_max_min();
            return val >= rule.min;
        }
        this.validate_maxlength = function () {
            pre_length();
            return val.length <= rule.maxlength;
        }
        this.validate_minlength = function () {
            pre_length();
            return val.length >= rule.minlength;
        }

        this.validate_numeric = function () {
            return $.isNumeric(val);
        }

        this.validate_required = function () {
            var real = $.trim(val) //修剪空格
            if (!real && real !== 0) {
                return false;
            }
            return true;
        }

        this.validate_pattern = function () {
            var reg = new RegExp(rule.pattern);
            return reg.test(val);
        }

        this.validate_equal = function () {
            return $('#password').val() === val;
        }
        // 用于this.validate_max或this.validate_min的前置工作
        function pre_max_min() {
            val = parseFloat(val);
        }

        // 用于this.validate_maxlength和this.validate_minlength的前置工作
        function pre_length() {
            val = val.toString();
        }

    }
})