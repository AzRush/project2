function recharge()
{
    let money = prompt('How many dollars do you want to recharge?');
    if(/^\d+$/.test(money) != true)
    {
        alert("Please input a number!")
        return;
    }
    $.ajax({
            type: "POST",
            url: "php/recharge.php",
            contentType: 'application/x-www-form-urlencoded;charset=utf-8',
            data: {money:parseInt(money),username:getCookie('username')},
            dataType: "json",

            error:function(e){
                alert("Recharge successfully!");
                document.getElementById("balance").innerHTML =  e.response.toString().replace("SUCCESS","");


            }
        }
    );
}