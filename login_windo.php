<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style type="text/css">
        *
        {
            padding:0;
            margin:0;
        }
        body
        {
            width: 90em;
            height:90em;
            font-family: "Lucida Console";
        }
        p
        {

            vertical-align: center;
        }
        button
        {

            /*text-decoration: none;*/
            border-top-right-radius: 0.5em
        }
        input
        {
            width:10em;
            margin: 1em 0 0 0;
            font-size: 1em;
            background-color: #ff7e59;
            border-color: #ece748;
            border-collapse: collapse;
        }
        .inputPanel
        {
            position: fixed;
            width: 100%;
            height:100%;
            /*background: rgba(255, 255, 255, 0.49);*/
            background: rgba(255, 255, 255, 0.42);
            z-index:9999;
        }
        .inputPanel form
        {
            position: fixed;
            /*text-align: left;*/
            width:36em;
            height:auto;
            border-radius: 0.5em;
            font-size:1em;
            background-color: #ffccc2;
            margin:8em 10em 5em 23em;
            padding:0 4em 1em 4em;
        }
        .panelTop
        {
            width:44em;
            margin:0 0 0 -4em;
            border-top-left-radius: 0.5em;
            border-top-right-radius: 0.5em;
            height:1.7em;
            position: absolute;
            background-color: #39ac11;
            display: inline-block;
        }
        .panelTop p
        {
            position: absolute;
            left:2em;
            top:0.4em;

        }
        .panelTop button
        {
            position:absolute;
            width:2em;
            height:2em;
            right:0;
        }
        .inputGroup
        {
            position: relative;
            margin:1em 0em 1em 0;
            top:1.5em;
        }

    </style>
</head>
<body>
<div id="loginPanel" class="inputPanel">
    <form action="#" method="post" target="frameFile" >
        <div id="loginTop" class="panelTop">
            <p>Login</p><button class="">×</button>
        </div>
        <div class="inputGroup">
            Username<br>
            <input type="text" name="username" id="username" onchange="username_check()" pattern="([0-9]|[a-z]|[A-Z]|&#95){1,}"><span id = "username_check">Username Required</span>
        </div>
        <div class="inputGroup">
            Password<br>
            <input type="password" name="password" id="password" onchange="password_check()"><span id = "password_check">Password Required</span>
        </div>

        <div class="inputGroup">
            <span id="problem">1 + 3 = ?</span> <input type="button" value="Refresh" onclick="problem_set()">
            <br>
            <input type="text" name="captcha" id = "captcha" onchange="captcha_check()"><span id = "captcha_check">Answer required</span>
        </div>
        <div class="inputGroup">
            <input type="submit" value="Login" name="login" onclick="login_check()" onsubmit="null">
        </div>
    </form>
    <iframe name='frameFile' style='display: none;'></iframe>
</div>


</body>
</html>