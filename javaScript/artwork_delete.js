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
                error:function(e){
                    if(e.response == 'Success')
                    alert("Delete " + artwork_title + " successfully!");
                }
            }
        );
    }
}