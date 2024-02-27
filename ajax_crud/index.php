
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ajax CRUD</h1>
        </div>
        <div class="search">
            <label>id</label>
            <input type="text" id="id">
            <label>First Name</label>
            <input type="text" name="fname" id="fname">
            <label>Last Name: </label>
            <input type="text" name="lname" id="lname">
            <input type="submit" id="save" value="Insert Data" style="height: 40px; width: 150px; background-color: lightblue; color: black; border-radius: 10px;">
        </div>
        <div class="table">
            <table id="tables"></table>
        </div>
    </div>
    <div class="model">
        <div class="model-form">
        <div class="close">X</div>
            <h3>Edit Your Details</h3>  <br>
            <table id="model-table">
                
            </table>
        </div>
    </div>
</body>
<script type="text/javascript">
     $(document).ready(function(){
        function printTable(){
            $.ajax({
                          url : "load-ajax.php",
                          type : "POST",
                          success : function(data){
                              $("#tables").html(data);
                          }
                      });
        }
        printTable();
    // Move the variable assignments inside the click event handler
    $("#save").on("click", function(e){
        e.preventDefault();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var id = $("#id").val();
        // Move these inside the click event handler to get the latest values
       
        $.ajax({
            url: "insert-ajax.php",
            type: "post",
            data: {first_name: fname, last_name: lname, id:id},
            success: function(data){
                if(data == 1){
                    console.log("query executed");
                    printTable();
                } else {
                    alert("something went wrong");
                }
            }
        });
    });
    $(document).on("click",".edit-button",function(){
        $(".model").show();
        var eid=$(this).data("eid");
        $.ajax({
              url: "edit-load.php",
              type: "post",
              data: {id:eid},
              success: function(data){
                  $("#model-table").html(data);
              }

        });
    });
    $(document).on("click", "#Edit", function(){
    var id = $("#edit-Id").val();
    var fname = $("#edit-first").val();
    var lname = $("#edit-last").val();

    $.ajax({
        url: "edit.php",
        type: "post",
        data: {id: id, fname: fname, lname: lname},
        success: function(data){
            if(data == 1){
                $(".model").hide(); // Use ".model" instead of "model"
                printTable();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error if the AJAX request fails
            console.error("AJAX Error: " + textStatus, errorThrown);
        }
    });
});

    $(document).on("click",".close",function(){
        $(".model").hide();
    });
    $(document).on("click",".delete",function(){
                       var stu_id=$(this).data("id");
                       var element=$(this);
                       $.ajax({
                       url: "delete.php",
                       type: "post",
                       data: {id:stu_id},
                       success: function(data){
                           if(data==1){
                            $(element).closest("tr").fadeOut(1000);
                           }
                              
                       }

                   });
                   });
                   
});



</script>
</html>