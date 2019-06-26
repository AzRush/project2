
// search_1 = function()
// {
//
// }
search_listener = function()
{
        let temp = event.keyCode;
            if(temp == 13)
            {
                window.location.href = "search.php?=" + document.getElementById("search").value;
            }
};
function footprint_create()
{
    let footprint = "<div id = 'footprint'>";
    let this_title = document.getElementsByTagName("title")[0].innerHTML;
    let this_url = document.documentURI;
    var footprint_title = getCookie("footprint_title");
    var footprint_url = getCookie("footprint_url");
    let title_found = 0;

    if(footprint_title == "")
    {
        setCookie("footprint_title",this_title,"7");
        setCookie("footprint_url",this_url,"7");
        return (footprint + "<a href=" + this_url + ">" + this_title + "</a></div>");
    }


    {
        var title_split = footprint_title.split(" ");
        var url_split = footprint_url.split(" ");
        var url_new = '';
        var title_new ='';
        for(let i = 0; i < title_split.length; i++)
        {
            if(title_split[i] != this_title)
            {
                footprint += "<a href=" + url_split[i] + ">" + title_split[i] + "</a><span>=></span>";
                title_new += title_split[i] + " ";
                url_new += url_split[i] + " ";
            }
            else
            {
                footprint += "<a href="+ this_url +">"+ title_split[i] + "</a>";
                title_new += title_split[i] + " ";
                url_new += this_url + " ";
                title_found = 1;
                break;
            }
        }
    }
    if(title_found == 0)
    {
        footprint += "<a href=" + this_url + ">" + this_title + "</a>";
        title_new += this_title;
        url_new += this_url;
    }

    title_new = title_new.trim();
    url_new = url_new.trim();
    setCookie("footprint_title",title_new,"7");
    setCookie("footprint_url",url_new,"7");
    footprint += "</div>";
    return footprint;
}
nav_create = function ()
{
    let username_cookie = getCookie("username");
    document.getElementById("header").innerHTML =         '<header> <a href="homepage.php"><img src="images/logo.png"></a> <span>LIFE IS BEAUTIFUL</span> <nav id="nav"> </nav> </header>';
    let nav_object = document.getElementById("nav");
    if(username_cookie != "")
    {
        nav_object.innerHTML ="<div><input type='text' id='search'  placeholder='search...' onkeydown='search_listener();'><button></button></div> <a href='homepage.php'>Home</a> <a href='details.php'>Details</a> <a href='cart.php'>Cart</a> <a href='myZone.php'>" + username_cookie + "</a> <a href=# onclick='logout()'>Logout</a>";
        document.getElementById("header").innerHTML += footprint_create();
        //console.log("13123");
        return 1;
    }
    else
    {
        nav_object.innerHTML ="<div><input type='text' id='search'  placeholder='search...' onkeydown='search_listener();'><button></button></div> <a href='homepage.php'>Home</a> <a href='details.php'>Details</a> <a href=# onclick='login_show()'>Login</a> <a href=# onclick='register_show()'>Register</a>";
        document.getElementById("header").innerHTML += footprint_create();
        //console.log("wr324");
        return 0;
    }
};
logout = function()
{
    $.ajax({
        type: "POST",
        url: "php/login_check.php",
        data:{method : "logout"},
        dataType: "json",
        error:function(e) {
            alert(e.response);
        }
        });
    setCookie("username","",0);
    location.reload();
}
