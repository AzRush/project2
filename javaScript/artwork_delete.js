function artwork_delete(artwork_id,artwork_title)
{
    if (confirm("Are you sure to delete " + artwork_title + "?")==true)
    {
        $.ajax({
                type: "POST",
                url: "php/artwork_delete.php",
                contentType: 'application/x-www-form-urlencoded;charset=utf-8',
                data: {artwork_id:artwork_id},
                dataType: "json",
                success:function(datas)
                {
                    alert("Delete '" + artwork_title + "' successfully!");
                    document.getElementById("uploaded").innerHTML = "<p>Released<a href='release.php'>Release New</a></p> <table> <tr> <td>Title</td><td>Time released</td><td>Delete</td></tr></table>";

                },
                error:function(e)
                {
                   alert("Delete '" + artwork_title + "' successfully!");
                   inner_html = e.response;
                   document.getElementById("uploaded").innerHTML = "<p>Released<a href='release.php'>Release New</a></p> <table> <tr> <td>Title</td><td>Time released</td><td>Delete</td></tr>" + inner_html + "</table>";
                }
            }
        );
    }
}