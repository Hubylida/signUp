$(function () {
    'use strict';

    window.Input = function (selector) {
        var $ele,
            $error_ele,
            rule = {
                required: true
            },
            me = this;

        this.load_validator = function (){
            var val = this.get_val();
            this.validator = new Validator(val,rule);
        }

        this.get_val = function (){
            return $ele.val();
        }

        function init() {
            find_ele();
            get_error_ele();
            parse_rule();
            me.load_validator();
            listen();
        }

        init();

        function listen(){
            $ele.on('blur',function(){
               var valid = me.validator.is_valid(me.get_val());
               if(valid){
                   $error_ele.fadeOut(300);
               }else{
                   $error_ele.fadeIn(300);
               }
            });
        }

        function get_error_ele(){
            $error_ele = $(get_error_selector());
        }

        function get_error_selector(){
            return '#' + $ele.attr('name') + '-input-error';
        }

        function find_ele() {
            if (selector instanceof jQuery) {
                $ele = selector;
            } else {
                $ele = $(selector);
            }
        }

        function parse_rule() {
            var i;
            var rule_str = $ele.data('rule');
            if (!rule_str) {
                return;
            }
            var rule_arr = rule_str.split('%');
            for (i = 0; i < rule_arr.length; i++){
                var item_str = rule_arr[i];
                var item_arr = item_str.split(':'); // ['min', '18']
                // rule是一个对象 var a = {}; a['b'] = 1; a = { b : 1}; a.b = 1;
                if(item_arr[0] === 'pattern'){
                    rule['pattern'] = item_arr[1];
                }else{
                    rule[item_arr[0]] = JSON.parse(item_arr[1]); //{min : 18}
                }
            }
            //正则表达式就是字符串了,不用JSON.parse()进行处理
            /* var a = "min:18"; var d = a.split(":"); d = ["min","18"]; d[1] = "18",这里的d[1]不是我们想要的18,而是字符串"18",
                如果我们用JSON.parse()解析的话,JSON.parse(d[1])的值为 18 假如 d[1] = '"18"', JSON.parse(d[1])的值为"18"*/
        }
    }
})