function release() {
    let title = document.getElementById("title");
    let artist = document.getElementById("artist");
    let genre = document.getElementById("genre");
    let yearOfWork = document.getElementById("yearOfWork");
    let height = document.getElementById("height");
    let width = document.getElementById("width");
    let price = document.getElementById("price");
    let description = document.getElementById("description");
    let file = document.getElementById("file");
    let image;
    let the_error = "";
    let no_error = 1;
    if (title.value == "" || title.value === null) {
        the_error = "Title required!\n"
        no_error = 0;
    }
    if (artist.value === "" || artist.value === null) {
        the_error += "Artist required!\n"
        no_error = 0;
    }
    if (genre.value === "" || genre.value === null) {
        the_error += "Genre required!\n"
        no_error = 0;
    }
    if (yearOfWork.value == null || yearOfWork.value === "") {
        the_error += "Year of work required!\n"
        no_error = 0;
    } else {
        let pattern = /^[0-9]*[1-9][0-9]*$/;
        if (!pattern.test(yearOfWork.value)) {
            the_error += "Year of work must be a integer!\n"
            no_error = 0;
        }
    }
    if (height.value == null || height.value == "") {
        the_error += "Height required!\n"
        no_error = 0;
    } else {
        let pattern = /^[0-9]*[1-9][0-9]*$/;
        if (!pattern.test(height.value)) {
            the_error += "Height must be a positive integer!\n"
            no_error = 0;
        }
    }
    if (width.value == null || width.value == "") {
        the_error += "Width required!\n"
        no_error = 0;
    } else {
        let pattern = /^[0-9]*[1-9][0-9]*$/;
        if (!pattern.test(width.value)) {
            the_error += "Width must be a positive integer!\n"
            no_error = 0;
        }
    }
    if (price.value == null || price.value == "") {
        the_error += "Price required!\n"
        no_error = 0;
    } else {
        let pattern = /^[0-9]*[1-9][0-9]*$/;
        if (!pattern.test(price.value)) {
            the_error += "Price must be a positive integer!\n"
            no_error = 0;
        }
    }
    if (description.value == "" || description.value === null) {
        the_error += "Description required!\n"
        no_error = 0;
    }
    if (file.files[0] == null) {
        the_error += "Image required!\n"
        no_error = 0;
    }
    else if(!/image(.*)/.test(file.files[0].type))
    {
        the_error += "Please choose an image file!"
        no_error = 0;
    }
    else
    {
        let file_reader = new FileReader();
        file_reader.readAsDataURL(file.files[0]);
        file_reader.onload = function ()
        {
            image = this.result;
        }
    }

    if (!no_error)
    {
        alert(the_error);
        return;
    }
    let the_JSON =
            {
                title:title.value,
                artist:artist.value,
                genre:genre.value,
                yearOfWork:yearOfWork.value,
                height:height.value,
                width:width.value,
                price:price.value,
                description:description.value,
                image:image
            };
    $.ajax({
            type: "POST",
            url: "php/artwork_add.php",
            contentType: 'application/x-www-form-urlencoded;charset=utf-8',
            data: the_JSON,
            dataType: "json",
            error:function(e)
            {
                if(e.response == "Success")
                {
                    alert(e.response);

                }
                else
                {
                    alert(e.response);

                }
            }
        }
    );


}
$(document).ready(function(){
    $("#image").bind("click",function()
    {

        $("#file").trigger("click");
    });
    document.getElementById("file").onchange = function ()
    {
        if(!/image(.*)/.test(this.files[0].type))
        {
            alert("Please choose an image file!");
            this.files[0] == null;
            return;
        }
        let file_reader = new FileReader();
        file_reader.readAsDataURL(this.files[0]);
        file_reader.onload = function ()
        {
            document.getElementById("image").src = this.result;
        }
    }




});

function fulfil(title,artist,genre,yearOfWork,height,width,description,price)
{
    document.getElementById("title").value = title;
    document.getElementById("artist").value = artist;
    document.getElementById("genre").value = genre;
    document.getElementById("yearOfWork").value = yearOfWork;
    document.getElementById("height").value = height;
    document.getElementById("width").value = width;
    document.getElementById("price").value = price;
    document.getElementById("description").value = description;
}