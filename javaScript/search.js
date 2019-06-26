function getPagination(pagination,key)
{

    let search_key= $('input:radio[name="search_key"]:checked').val();
    let search_order= $('input:radio[name="search_order"]:checked').val();
    $.ajax({
            type: "GET",
            url: "php/search_result.php",
            contentType: 'application/x-www-form-urlencoded;charset=utf-8',
            data: {pagination:pagination,key:key,search_key:search_key,search_order,search_order},
            dataType: "json",
            success:function(data)
            {
                // alert(data['pagination']);
                // alert(data['display']);
                document.getElementById("pagination").innerHTML=data['pagination'];
                document.getElementById("display").innerHTML=data['display'];
                // let oldNode = document.getElementById("sort");
                // let newNode = document.createElement("div");
                // let parentNode = oldNode.parentNode;
                // newNode.innerHTML = data['display'];
                // newNode.id="display";
                // parentNode.insertBefore(newNode,oldNode.nextSibling);
                // oldNode = newNode;
                // newNode = document.createElement("ul");
                // parentNode = oldNode.parentNode;
                // newNode.innerHTML = data['pagination'];
                // newNode.className = "pagination";
                // newNode.id ="pagination";
                // parentNode.insertBefore(newNode,oldNode.nextSibling);
            },
            error:function(e){
                if(e.response == "fail")
                {
                    let oldNode = document.getElementById("sort");
                    let newNode = document.createElement("h2");
                    let parentNode = oldNode.parentNode;
                    newNode.innerHTML = "No result found";
                    parentNode.insertBefore(newNode,oldNode.nextSibling);
                }
                else
                {
                    alert(e.response);

                }
            }
        }
    );
    
}