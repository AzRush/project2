<?php
session_start();
include 'php/database_connect.php';
if(!isset($_SESSION['user']))
{
    echo "<script>alert('Please login first!');top.location = 'homepage.php';</script>";
}
else
{
    $current_user_sql = preg_replace("/username/",$_SESSION['user'],'SELECT * FROM users WHERE name="username"');
    $current_user_query = mysqli_query($mysql, $current_user_sql);
    $current_user = mysqli_fetch_assoc($current_user_query);
    if(isset($_GET['artworkID']))
    {
        $sql = "SELECT * FROM artworks WHERE artworkID=_artworkID";
        $sql = preg_replace("/_artworkID/",$_GET['artworkID'],$sql);
        $sql_result = mysqli_query($mysql,$sql);
        $the_artwork = mysqli_fetch_assoc($sql_result);
        if($the_artwork['ownerID']!=$current_user['userID'])
        {
            $to_echo = "<script>alert('Reject!');window.history.go(-1);</script>";
            echo $to_echo;
            return;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Release</title>
    <link href="display/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet"  type="text/css" href="css/reset.css">
    <link rel="stylesheet"  type="text/css" href="css/global.css">
    <link rel="stylesheet"  type="text/css" href="css/release.css">
    <script type="text/javascript" src="display/jquery-1.4.2.min.js"></script>
    <script src="javaScript/header.js"></script>
    <script src="javaScript/release.js"></script>
    <script src="javaScript/cookie_manage.js"></script>
    <script rel="script" type="text/javascript" src="javaScript/login.js"></script>
    <script rel="script" type="text/javascript" src="javaScript/register.js"></script>
</head>
<body onload="nav_create()">

<div id="loginPanel" class="inputPanel" hidden>
    <form action="#" method="post" target="frameFile" >
        <div id="loginTop" class="panelTop">
            <p>Login</p><button onclick="login_close()">×</button>
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
<div id="registerPanel" class="inputPanel" hidden>
    <iframe name='frameFile' style='display: none;'></iframe>
    <form action="#" method="POST" style="margin-top: 0.5em"target="frameFile">
        <div id="registerTop" class="panelTop">
            <p>Register</p><button onclick="register_close()">×</button>
        </div>
        <p class="inputGroup">
            Username<br>
            <input type="text" name="username" id="register_username" onchange="register_username_check()"><span id = "register_username_check">Username Required</span>
        </p>
        <p class="inputGroup">
            Password<br>
            <input type="password" name="password" id="register_password" onchange="register_password_check();register_password_confirm_check()"><span id = "register_password_check">Password Required</span>
        </p>


        <p class="inputGroup">
            Confirm your Password<br>
            <input type="password" name="register_password_confirm" id="register_password_confirm" onchange="register_password_confirm_check()"><span id = "register_password_confirm_check">Password Required</span>
        </p>
        <p class="inputGroup">
            Address<br>
            <input type="text" name="register_address" id="register_address" onchange="register_address_check()"><span id = "register_address_check">Address Required</span>
        </p>
        <!--        <p class="inputGroup">-->
        <!--            Address<br>-->
        <!--            <select name="area">-->
        <!--                <option value="上海" selected>上海</option>-->
        <!--                <option value="北京">北京</option>-->
        <!--                <option value="天津">天津</option>-->
        <!--                <option value="河北">河北</option>-->
        <!--                <option value="山西">山西</option>-->
        <!--                <option value="内蒙古">内蒙古</option>-->
        <!--                <option value="辽宁">辽宁</option>-->
        <!--                <option value="吉林">吉林</option>-->
        <!--                <option value="黑龙江">黑龙江</option>-->
        <!--                <option value="江苏">江苏</option>-->
        <!--                <option value="浙江">浙江</option>-->
        <!--                <option value="江西">江西</option>-->
        <!--                <option value="安徽">安徽</option>-->
        <!--                <option value="福建">福建</option>-->
        <!--                <option value="山东">山东</option>-->
        <!--                <option value="河南">河南</option>-->
        <!--                <option value="湖北">湖北</option>-->
        <!--                <option value="湖南">湖南</option>-->
        <!--                <option value="广东">广东</option>-->
        <!--                <option value="广西">广西</option>-->
        <!--                <option value="海南">海南</option>-->
        <!--                <option value="重庆">重庆</option>-->
        <!--                <option value="四川">四川</option>-->
        <!--                <option value="贵州">贵州</option>-->
        <!--                <option value="云南">云南</option>-->
        <!--                <option value="西藏">西藏</option>-->
        <!--                <option value="陕西">陕西</option>-->
        <!--                <option value="甘肃">甘肃</option>-->
        <!--                <option value="青海">青海</option>-->
        <!--                <option value="宁夏">宁夏</option>-->
        <!--                <option value="新疆">新疆</option>-->
        <!--                <option value="香港">香港</option>-->
        <!--                <option value="澳门">澳门</option>-->
        <!--                <option value="台湾">台湾</option>-->
        <!--            </select>-->
        <!--        </p>-->
        <p class="inputGroup">
            E-mail<br>
            <input type="email" name="email" id = "register_email" onchange="register_email_check()"><span id = "register_email_check">E-mail Required</span>
        </p>
        <p class="inputGroup">
            Telephone Number<br>
            <input type="tel" name="telephone" id = "register_telephone" onchange="register_telephone_check()"><span id = "register_telephone_check">Telephone Number Required</span>
        </p>

        <p class="inputGroup">
            <span id="register_problem">1 + 3 = ?</span> <input type="button" value="Refresh" onclick="register_problem_set()">
            <br>
            <input type="text" name="captcha" id = "register_captcha" onchange="register_captcha_check()"><span id = "register_captcha_check">Answer required</span>
        <p>
        <p class="inputGroup">
            Please read the contract below.
        </p>
        <textarea disabled="true" class="inputGroup">
1、本站服务条款
本站提供的服务将完全按照服务条款严格执行。用户必须完全同意所有服务条款并完成注册程序，才能成为本站的正式用户。
考虑到本站所提供的网络服务的重要性，用户应同意：
（1）提供详尽、准确的个人资料。
（2）如个人资料有任何变动，必须及时更新。
本站不公开用户的姓名、地址、电子邮箱、证件，除以下情况外：
（3）用户授权本站透露这些信息。
（4）相应的法律及程序要求本站提供用户的个人资料。
如果用户提供的资料不准确，不真实，不合法有效，本站保留结束用户使用各项服务的权利。
2、服务条款的修改和服务修订
本站有权在必要时修改服务条款，本站服务条款一旦发生变动，将会在相关页面上提示修改内容。如果不同意所改动的内容，用户可以主动取消获得的网络服务。如果用户继续享用网络服务，则视为接受服务条款的变动。
本站保留随时修改或中断服务而不需个别知照用户的权利。本站行使修改或中断免费服务的权利，不需对用户或第三方负责。
3、用户隐私制度
尊重用户个人隐私是本站的一项基本政策。本站一定不会在未经合法用户授权时公开、透露其注册资料及保存在本站中的非公开内容，除非有法律许可要求或本站在诚信的基础上认为透露这些信息在以下四种情况是必要的：
（1）遵守有关法律规定，遵从本站合法服务程序。包括在国家有关机关查询时，提供用户在本站上发布的信息内容及其发布时间、互联网地址或者域名。
（2）保持维护本站的商标所有权。
（3）在紧急情况下竭力维护用户个人和社会大众的隐私安全。
（4）符合其他相关的要求。
4、用户的帐号，密码和安全性
用户一旦注册成功，成为本站的合法用户，将得到一个密码和用户名。如果您未保管好自己的帐号和密码而对您、本站或第三方造成的损害，您将负全部责任。另外，每个用户都要对其帐户中的所有活动和事件负全责。您可随时改变您的密码，也可以结束旧的帐户重开一个新帐户。用户若发现任何非法使用用户帐号或存在安全漏洞的情况，请立即通告我们
5、拒绝提供担保
用户个人对网络服务的使用承担风险。本站对此不作任何类型的担保，不论是明确的或隐含的。本站不担保服务一定能满足用户的要求，也不担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保。
6、有限责任
本站对任何直接、间接、偶然、特殊及继起的损害不负责任，这些行为都有可能会导致本站的形象受损，所以本站事先提出这种损害的可能性。
7、对用户信息的存储和限制
本站不对用户所发布信息的删除或储存失败负责。本站有判定用户的行为是否符合本站服务条款的要求和精神的保留权利，如果用户违背了服务条款的规定，本站有中断对其提供网络服务的权利。本站社区各栏目的管理员和版主、本站空间管理员有权保留或删除其管辖社区中的任意内容。
8、用户管理
（1）用户使用本站各项服务的权利是个人的。用户只能是一个单独的个体而不能是一个公司或实体的商业性组织。用户承诺不经本站同意，不能利用本站各项服务、资讯、资料、数据等进行销售或其他商业用途。
　　（2）用户单独承担发布内容的责任。用户对服务的使用户在本站发表的内容（包含但不限于本站目前各产品功能里的内容）仅表明其个人的立场和观点，并不代表本站的立场或观点。作为内容的发表者，需自行对所发表的内容以及其他任何形式关于本站的内容负责（如包含本站内容的邮件、短信、电话录音等），因所发表内容引发的一切纠纷，由该内容的发表者承担全部法律及连带责任。本站不承担任何法律及连带责任。
在本站的网页上发布信息或者利用本站的服务时必须符合中国有关法规，不得在本站的网页上或者利用本站的服务制作、复制、发布、传播以下信息：
（a） 反对宪法所确定的基本原则的；
（b） 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；
（c） 损害国家荣誉和利益的；
（d） 煽动民族仇恨、民族歧视，破坏民族团结的；
（e） 破坏国家宗教政策，宣扬邪教和封建迷信的；
（f） 散布谣言，扰乱社会秩序，破坏社会稳定的；
（g） 散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；
（h） 侮辱或者诽谤他人，侵害他人合法权益的；
（i） 含有法律、行政法规禁止的其他内容的。
（3）在本站的网页上发布信息或者利用本站的服务时还必须符合其他有关国家和地区的法律规定以及国际法的有关规定。
（4）不利用本站的服务从事以下活动：
（a） 未经允许，进入计算机信息网络或者使用计算机信息网络资源的；
（b） 未经允许，对计算机信息网络功能进行删除、修改或者增加的；
（c） 未经允许，对进入计算机信息网络中存储、处理或者传输的数据和应用程序进行删除、修改或者增加的；
（d） 故意制作、传播计算机病毒等破坏性程序的；
（e） 其他危害计算机信息网络安全的行为。
（5）不以任何方式干扰本站的服务。
（6）遵守本站的所有其他规定和程序。
用户使用本站电子公告服务，即用户利用本站交互形式的栏目或功能，进行信息发布的行为，也须遵守本条的规定以及本站专门发布的相关电子公告服务的规则，上段中描述的法律后果和法律责任同样适用于电子公告服务的用户。
若用户的行为不符合以上提到的服务条款，本站将作出独立判断立即取消用户服务帐号。
9、保障
用户同意保障和维护本站全体成员的利益，并负责支付由用户使用超出服务范围引起的律师费用，违反服务条款的损害补偿费用等。
10、结束服务
用户或本站可随时根据实际情况中断一项或多项网络服务。本站不需对任何个人或第三方负责而随时中断服务。用户对后来的条款修改有异议，或对本站的服务不满，可以行使如下权利：
（1）停止使用本站的网络服务。
（2）通告本站停止对该用户的服务。
结束用户服务后，用户使用网络服务的权利马上中止。从那时起，用户没有权利，本站也没有义务传送任何未处理的信息或未完成的服务给用户或第三方。
11、通告
所有发给用户的通告都可通过相关页面的公告或电子邮件或常规的信件等传送。服务条款的修改、服务变更、或其它重要事件的通告都会以此形式进行。
12、网络服务内容的所有权
本站定义的网络服务内容包括：文字、软件、声音、图片、录象、图表中的全部内容；电子邮件的全部内容；本站为用户提供的其他信息。所有这些内容受版权、商标、标签和其它财产所有权法律的保护。所以，用户只能在本站授权下才能使用这些内容，而不能擅自复制、再造这些内容、或创造与内容有关的派生产品。本站内所有的文章、资讯、资料、数据版权归原文作者和本站共同所有，任何人需要转载，必须征得原文作者或本站授权。本站注册用户在本站社区发表的作品，本站有权在网站内免费使用。
13、法律
网络服务条款要与中华人民共和国的法律解释相一致，用户和本站一致同意服从高等法院所有管辖。如发生本站服务条款与中华人民共和国法律相抵触时，则这些条款将完全按法律规定重新解释，而其它条款则依旧保持对用户产生法律效力和影响。
</textarea>
        <br>
        <input type="radio" value="agree" name="agree" id="agree" aria-required="true" onclick="option_agree()">Agree
        <input type="radio" value="disagree" name="agree" id="disagree" onclick="option_disagree()">Disagree
        <p>
            <input type="submit" value="Register" name="register" onclick="register_check()">
        </p>
    </form>
</div>
<div id="header" >
    <header>
        <a href="homepage.php"><img src="images/logo.png"></a>
        <span>LIFE IS BEAUTIFUL</span>
        <nav id="nav">

        </nav>
    </header>
</div>
<div id="middle">
    <input accept="image/gif,image/jpeg,image/jpg,image/png" type="file" id="file">
    <div id="middle1">

        <?php
            if(isset($_GET['artworkID']))
            {
                echo "<img id = 'image' src=\"img/" . $the_artwork['imageFileName'] ."\">";
                echo "<script>imageInitialize();</script>";
            }
            else
            {
                echo "<img id = 'image'>";
            }
        ?>
    </div>

    <div id="middle2">
        <table>
            <th colspan="2">Details</th>
            <tr>
                <td class="alt_name">Title:</td>
                <td class="alt_value" ><input class="alt_submit" type="text" id="title"></td>
            </tr>
            <tr>
                <td class="alt_name">Artist:</td>
                <td class="alt_value" ><input class="alt_submit" type="text" id="artist"></td>
            </tr>
            <tr class="alt">
                <td class="alt_name">Genre:</td>
                <td class="alt_value" ><input class="alt_submit" type="text" id="genre"></td>
            </tr>
            <tr>
                <td class="alt_name">Year of Work:</td>
                <td class="alt_value" ><input class="alt_submit" type="number" id="yearOfWork"></td>
            </tr>
            <tr class="alt">
                <td class="alt_name">Height(cm):</td>
                <td class="alt_value" ><input class="alt_submit" type="number" id="height"></td>
            </tr>
            <tr>
                <td class="alt_name">Width(cm):</td>
                <td class="alt_value" ><input class="alt_submit" type="number" id="width"</td>
            </tr>
            <tr>
                <td class="alt_name">Price($USD):</td>
                <td class="alt_value" ><input class="alt_submit" type="number" id="price"</td>
            </tr>
            <tr class="alt">
                <td class="alt_name">Description:</td>
                <td class="alt_value"><textarea id='description' type="text"></textarea></td>
            </tr>
        </table>
        <?php
        if(isset($_GET['artworkID']))
        {
            $to_echo = "<script>fulfil('_title','_artist','_genre',_yearOfWork,_height,_width,'_description',_price)</script>";
            $to_echo = preg_replace("/_title/",$the_artwork['title'],$to_echo);
            $to_echo = preg_replace("/_genre/",$the_artwork['genre'],$to_echo);
            $to_echo = preg_replace("/_artist/",$the_artwork['artist'],$to_echo);
            $to_echo = preg_replace("/_yearOfWork/",$the_artwork['yearOfWork'],$to_echo);
            $to_echo = preg_replace("/_height/",$the_artwork['height'],$to_echo);
            $to_echo = preg_replace("/_width/",$the_artwork['width'],$to_echo);
            $the_description = $the_artwork['description'];
            $the_description=preg_replace("/\'/","\\\'",$the_description);
            $the_description=preg_replace('/\"/',"\\\"",$the_description);
            $the_description=str_replace("\r\n","\\r\\n",$the_description);
            $the_description=str_replace("<em>","",$the_description);
            $the_description=str_replace("</em>","",$the_description);
            $to_echo = preg_replace("/_description/",$the_description,$to_echo);
            $to_echo = preg_replace("/_price/",$the_artwork['price'],$to_echo);
            echo $to_echo;
        }
        ?>
        <?php
        if(isset($_GET['artworkID']))
        {
            echo "<a onclick='release(".$the_artwork['artworkID'].")'>Release</a>";
        }
        else
        {
            echo "<a onclick='release()'>Release</a>";
        }
        ?>

    </div>
</div>
<div id="br"></div>
<footer><span>Copyright © 2019 Az Rush. All rights reserved.</span></footer>
</body>
</html>