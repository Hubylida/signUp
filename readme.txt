首页--index.html
注册页面--register.html
登录页面--login.html
报名页面--signUp.html
提示（消息发布页面）--tip.html

input自定以属性data-rule="maxlength:10%minlength:2%max:10%min:2"
main.js会获取带有data-rule属性的input然后为每一个input创建一个对象,这个对象有一个方法load_validator
会创建一个validator的对象,validator有验证输入的方法,validator是由构造函数Validator创建的,创建时向构造函数
传入val和rule的值.
这两个构造函数Input和Validator都是全局函数,在全局下之暴露这两个函数.