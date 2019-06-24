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