cart_add = function(ID)
{
    $.ajax({
            type: "POST",
            url: "php/cart_add.php",
            contentType: 'application/x-www-form-urlencoded;charset=utf-8',
            data: {artworkID: ID},
            dataType: "json",

            error:function(e){
                if(e.response == "Success")
                {
                    alert("Add to cart successfully!");
                    return;
                }
                if(e.response == "Exist")
                {
                    alert("Added already!");
                    return;
                }
                if (e.response == "Purchased")
                {
                    alert("The artwork has been sold!");
                    return;
                }
                if(e.response == "Self")
                {
                    alert("You can't by your own artwork!");
                    return;
                }
                else if(e.response == "User")
                {
                    alert("Please login first!");
                    return;
                }

            }
        }
    );
}
function cart_remove(artwork_id,artwork_title)
{
    if (confirm("Are you sure to remove " + artwork_title + "?")==true)
    {
        $.ajax({
                type: "POST",
                url: "php/cart_remove.php",
                contentType: 'application/x-www-form-urlencoded;charset=utf-8',
                data: {artwork_id:artwork_id},
                dataType: "json",
                success:function(datas)
                {
                    // alert("Delete '" + artwork_title + "' successfully!");
                    // document.getElementById("uploaded").innerHTML = "<p>Released<a href='release.php'>Release New</a></p> <table> <tr> <td>Title</td><td>Time released</td><td>Delete</td></tr></table>";

                },
                error:function(e)
                {
                    alert(e.response);
                    document.getElementById(artwork_id).remove();
                    $.ajax({
                            type: "POST",
                            url: "php/cart_sum.php",
                            contentType: 'application/x-www-form-urlencoded;charset=utf-8',
                            data: {method:"get_sum"},
                            dataType: "json",
                            success:function(datas)
                            {
                                if(datas == 0)
                                {
                                    document.getElementById("price_sum").remove();
                                    document.getElementById("checkout").remove();
                                    return;
                                }
                                // alert("Delete '" + artwork_title + "' successfully!");
                                // document.getElementById("uploaded").innerHTML = "<p>Released<a href='release.php'>Release New</a></p> <table> <tr> <td>Title</td><td>Time released</td><td>Delete</td></tr></table>";
                                document.getElementById("price_sum").innerHTML ="Sum: " + datas + "$";
                            },
                        }
                    );
                    //alert("Delete '" + artwork_title + "' successfully!");
                    //inner_html = e.response;
                    //document.getElementById("uploaded").innerHTML = "<p>Released<a href='release.php'>Release New</a></p> <table> <tr> <td>Title</td><td>Time released</td><td>Delete</td></tr>" + inner_html + "</table>";
                }
            }
        );
    }
}
function checkOut() {
    $.ajax({
            type: "POST",
            url: "php/cart_checkOut.php",
            contentType: 'application/x-www-form-urlencoded;charset=utf-8',
            data: {method:"cart_checkOut"},
            dataType: "json",
            success:function(datas)
            {
                // alert("Delete '" + artwork_title + "' successfully!");
                // document.getElementById("uploaded").innerHTML = "<p>Released<a href='release.php'>Release New</a></p> <table> <tr> <td>Title</td><td>Time released</td><td>Delete</td></tr></table>";
                // document.getElementById("price_sum").innerHTML ="Sum: " + datas + "$";
                alert(datas);
            },
            error:function (e)
            {
                if(e.response == 'Success')
                {
                    alert("Checkout successfully!");
                    // document.getElementById("price_sum").innerHTML = "0$";
                    // document.getElementById("the_cart").innerHTML ="<h1>Your Cart</h1>";
                }
                else

                {
                    alert(e.response);
                }

            }
        }
    );
}