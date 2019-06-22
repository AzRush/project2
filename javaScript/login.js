var username_valid = 0,password_valid = 0,captcha_valid = 0,a1,a2,a3;
var username = [ "AzRush1","AzRush2"];
var password = ["1234567","123456"];
problem_set = function () {
    a1 = Math.round(Math.random() * 8 + 1);
    a2 = Math.round(Math.random() * 8 + 1);
    a3 = a1 + a2;
    // let str = a1 + " + " + a2 +" =?"
    document.getElementById("problem").innerHTML =a1 + "   +   " + a2 +"   =   ?";
};
username_check = function()
{
    let username1 = document.getElementById("username");
    let patt;
    if ((username1 == null) || (username1.value.length == 0))
    {
        document.getElementById("username_check").innerHTML = "Username required";
        document.getElementById("username_check").style.color = "#ff2d1f";
        username_valid = 0;
    }
    else
    {
        if(username1.value.length < 6)
        {
            document.getElementById("username_check").innerHTML = "Too short";
            username_valid = 0;
            return;
        }
        patt = /^[a-zA-Z0-9_]+$/;
        if (patt.test(username1.value))
        {
            document.getElementById("username_check").innerHTML = "";
            username_valid = 1;

        }
        else
        {
            document.getElementById("username_check").innerHTML = "Number,Letter and _ Only";
            username_valid = 0;
        }
    }

};
password_check = function ()
{
    let password1 = document.getElementById("password");
    if ((password1 == null) || (password1.value.length == 0))
    {
        document.getElementById("password_check").innerHTML = "password required";
        document.getElementById("password_check").style.color = "#ff2d1f";
        password_valid = 0;
    }
    else
    {
        if(password1.value.length < 6)
        {
            document.getElementById("password_check").innerHTML = "Too short";
            password_valid = 0;
            return;
        }
        else
        {
            document.getElementById("password_check").innerHTML = "";
            password_valid = 1;
        }
    }
};

captcha_check = function () {
    let captcha = document.getElementById("captcha");
    if((captcha == null) || (captcha.value.length == 0))
    {
        document.getElementById("captcha_check").innerHTML = "Answer required";
        document.getElementById("captcha_check").style.color = "#ff2d1f";
        captcha_valid = 0;
    }
    else
    {
        if(Number(captcha.value) == a3)
        {
            captcha_valid = 1;
            document.getElementById("captcha_check").innerHTML = "Right";
            document.getElementById("captcha_check").style.color = "#6dd20e";

        }
        else
        {
            captcha_valid = 0;
            document.getElementById("captcha_check").innerHTML = "Wrong answer";
            document.getElementById("captcha_check").style.color = "#ff2d1f";
        }
    }
};

login_check = function ()
{
    if(!username_valid || !password_valid || !captcha_valid)
    {
        window.alert("Failed!");
        return;
    }
    let username1 = document.getElementById("username");
    let password1 = document.getElementById("password");
    $.ajax({
        type: "POST",
        url: "php/login_check.php",
        contentType: 'application/x-www-form-urlencoded;charset=utf-8',
        data: {method: "login" , username:$(username1).val(), password:$(password1).val()},
        dataType: "json",

        error:function(e){
                 if(e.response == "Success")
                 {
                    alert("Login as " + username1.value);
                    setCookie("username",username1.value,"1");
                    nav_create();
                    login_close();
                 }
                 else
                 {
                     alert(e.response);
                     problem_set();
                     document.getElementById("captcha").value = '';
                     captcha_check();
                 }
             }
});

    // let login_form = document.getElementById("login_form");
    // login_form.submit();
    // let username1 = document.getElementById("username");
    // let password1 = document.getElementById("password");
    // let login_valid = 0;
    // let username_found = 0;
    // for (let i = 0; i < username.length; i++)
    // {
    //     if(username[i] === username1.value)
    //     {
    //         username_found = 1;
    //         if(password1.value == password[i])
    //         {
    //             login_valid= 1;
    //             window.alert("Login as " + username[i]);
    //             setCookie("username",username[i],"1");
    //             nav_create();
    //             login_close();
    //             // window.history.back(-1);
    //             break;
    //
    //         }
    //     }
    // }
    // if(!username_found)
    // {
    //     window.alert("Username not found!");
    //     return;
    // }
    // if(login_valid == 0)
    // {
    //     window.alert("Failed!");
    // }

};
login_close = function ()
{
    let login_window = document.getElementById("loginPanel");
    let username1 = document.getElementById("username");
    let password1 = document.getElementById("password");
    let captcha = document.getElementById("captcha");
    username1.value = "";
    password1.value = "";
    captcha.value = "";
    username_check();
    password_check();
    captcha_check();
    login_window.hidden = true;
}
login_show = function ()
{
    problem_set();
    let login_window = document.getElementById("loginPanel");
    login_window.hidden = false;
}