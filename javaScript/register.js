var username_valid = 0,password_valid = 0,captcha_valid = 0,telephone_valid=0,password_confirm_valid = 0,address_valid = 0,email_valid = 0,agree_valid=0,a1,a2,a3;
var username = [ "AzRush1","AzRush2"];
var password = ["1234567","123456"];
var username_now,password_now;
register_problem_set = function () {
    a1 = Math.round(Math.random() * 8 + 1);
    a2 = Math.round(Math.random() * 8 + 1);
    a3 = a1 + a2;
    // let str = a1 + " + " + a2 +" =?"
    document.getElementById("register_problem").innerHTML =a1 + "   +   " + a2 +"   =   ?";
}
register_username_check = function()
{
    let username1 = document.getElementById("register_username");
    let patt;
    if ((username1 == null) || (username1.value.length == 0))
    {
        document.getElementById("register_username_check").innerHTML = "Username required";
        username_valid = 0;
    }
    else
    {
        if(username1.value.length < 6)
        {
            document.getElementById("register_username_check").innerHTML = "Too short";
            username_valid = 0;
            return;
        }
        patt = /^[a-zA-Z0-9_]+$/;
        if (patt.test(username1.value))
        {
            document.getElementById("register_username_check").innerHTML = "";
            username_valid = 1;
            username_now = username1.value;
        }
        else
        {
            document.getElementById("register_username_check").innerHTML = "Number,Letter and _ Only";
            username_valid = 0;
        }
    }
}
register_password_check = function ()
{
    let password1 = document.getElementById("register_password");
    if ((password1 == null) || (password1.value.length == 0))
    {
        document.getElementById("register_password_check").innerHTML = "password required";
        password_valid = 0;
    }
    else
    {
        if(password1.value.length < 6)
        {
            document.getElementById("register_password_check").innerHTML = "Too short";
            password_valid = 0;
            return;
        }
        let patt = /^.*(?=.{6,})(?=.*[A-Za-z0-9!@#$%^&*_?]).*$/;
        if(/^\d+$/.test(password1.value))
        {
            document.getElementById("register_password_check").innerHTML = "Password can't be numeric!";
            password_valid = 0;
            return;
        }
        else if (patt.test(password1.value))
        {
            document.getElementById("register_password_check").innerHTML = "";
            password_valid = 1;

        }
        else
        {
            document.getElementById("register_password_check").innerHTML = "Number,Letter and !@#$%^&*_? Only";
            password_valid = 0;
        }
    }
}

register_telephone_check = function()
{
    let telephone1 = document.getElementById("register_telephone");
    let patt;
    if ((telephone1 == null) || (telephone1.value.length == 0))
    {
        document.getElementById("register_telephone_check").innerHTML = "telephone required";
        telephone_valid = 0;
    }
    else
    {
        patt = /^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\d{8}$/;
        if (patt.test(telephone1.value))
        {
            document.getElementById("register_telephone_check").innerHTML = "";
            telephone_valid = 1;

        }
        else
        {
            document.getElementById("register_telephone_check").innerHTML = "invalid telephone number";
            telephone_valid = 0;
        }
    }
}
register_email_check = function()
{
    let email1 = document.getElementById("register_email");
    let patt;
    if ((email1 == null) || (email1.value.length == 0))
    {
        document.getElementById("register_email_check").innerHTML = "E-mail required";
        email_valid = 0;
    }
    else
    {
        patt = /^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/;;
        if (patt.test(email1.value))
        {
            document.getElementById("register_email_check").innerHTML = "";
            email_valid = 1;

        }
        else
        {
            document.getElementById("register_email_check").innerHTML = "invalid E-mail address";
            email_valid = 0;
        }
    }
};
register_address_check = function()
{
    let address1 = document.getElementById("register_address");
    if ((address1 == null) || (address1.value.length == 0))
    {
        document.getElementById("register_address_check").innerHTML = "Address required";
        address_valid = 0;
    }
    else
    {
        document.getElementById("register_address_check").innerHTML = "";
        address_valid = 1;

    }
};

register_captcha_check = function () {
    let captcha = document.getElementById("register_captcha");
    if((captcha == null) || (captcha.value.length == 0))
    {
        document.getElementById("register_captcha_check").innerHTML = "Answer required";
        document.getElementById("register_captcha_check").style.color = "#ff2d1f";
        captcha_valid = 0;
    }
    else
    {
        if(Number(captcha.value) == a3)
        {
            captcha_valid = 1;
            document.getElementById("register_captcha_check").innerHTML = "Right";
            document.getElementById("register_captcha_check").style.color = "#6dd20e";

        }
        else
        {
            captcha_valid = 0;
            document.getElementById("register_captcha_check").innerHTML = "Wrong answer";
            document.getElementById("register_captcha_check").style.color = "#ff2d1f";
        }
    }
}
register_password_confirm_check = function ()
{
    let password1 = document.getElementById("register_password_confirm");
    let password2 = document.getElementById("register_password");
    if ((password1 == null) || (password1.value.length == 0))
    {
        document.getElementById("register_password_confirm_check").innerHTML = "password required";
        password_confirm_valid = 0;
    }
    else
    {
        if (password1.value === password2.value)
        {
            document.getElementById("register_password_confirm_check").innerHTML = "";
            password_confirm_valid = 1;
            password_now = password1.value;
        }
        else
        {
            document.getElementById("register_password_confirm_check").innerHTML = "Not match";
            password_confirm_valid = 0;
        }
    }
}
option_agree = function()
{
    agree_valid = 1;
}
option_disagree = function()
{
    agree_valid = 0;
}
register_check = function ()
{
    if(!username_valid || !password_valid || !captcha_valid || !password_confirm_valid ||!agree_valid || !address_valid || !email_valid)
    {
        window.alert("Failed!");
        return;
    }
    let username1 = document.getElementById("register_username");
    let password1 = document.getElementById("register_password");
    let address1 = document.getElementById("register_address");
    let email1 = document.getElementById("register_email");
    let telephone1 = document.getElementById("register_telephone");
    $.ajax({
            type: "POST",
            url: "php/register_check.php",
            contentType: 'application/x-www-form-urlencoded;charset=utf-8',
            data: {method: "register" , username:$(username1).val(), password:$(password1).val(),email: $(email1).val(),address: $(address1).val(), telephone:$(telephone1).val()},
            dataType: "json",

            error:function(e){
                if(e.response == "Success")
                {
                    alert("Register as " + username1.value);
                    setCookie("username",username1.value,"1");
                    nav_create();
                    register_close();
                }
                else
                {
                    alert(e.response);
                    register_problem_set();
                    document.getElementById("captcha").value = '';
                    register_captcha_check();
                }
            }
        }
    );
    // for (let i = 0; i < username.length; i++)
    // {
    //     if(username[i] === username1.value)
    //     {
    //         register_valid = 0;
    //         window.alert("Username existed!");
    //     }
    // }
    // if(register_valid == 1)
    // {
    //     window.alert("Register as " + username_now);
    //     register_close();
    // }
}
register_close = function ()
{
    let register_window = document.getElementById("registerPanel");
    let username1 = document.getElementById("register_username");
    let password1 = document.getElementById("register_password");
    let captcha = document.getElementById("register_captcha");
    let address1 = document.getElementById("register_address");
    let email1 = document.getElementById("register_email");
    let telephone1 = document.getElementById("register_telephone");
    let confirm_password1 = document.getElementById("register_password_confirm");
    address1.value = "";
    telephone1.value = "";
    username1.value = "";
    password1.value = "";
    captcha.value = "";
    confirm_password1.value = "";
    email1.value = "";
    register_telephone_check()
    register_username_check();
    register_password_check();
    register_password_confirm_check();
    register_captcha_check();
    register_address_check();
    register_email_check();
    register_window.hidden = true;
}
register_show = function ()
{
    register_problem_set();
    let register_window = document.getElementById("registerPanel");
    register_window.hidden = false;
}
