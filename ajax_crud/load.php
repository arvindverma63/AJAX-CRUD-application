<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>List Search Ajax</h1>
        </div>
        <div class="search">
            Search: <input type="text" id="search" autocomplete="off">
        </div>
        <div class="table">
            <table id="tables">
                
            </table>
        </div>
    </div>
    <a href="index.php"><div class="next">Back</div></a>
    <br>
    
</body>
         <script>
           $(document).ready(function(){
               function printTable(page){
                      $.ajax({
                          url : "pagination.php",
                          type : "POST",
                          data: {pageNo: page},
                          success : function(data){
                              $("#tables").html(data);
                          }
                      });
               }
               printTable();

               $(document).on("click",".page a",function(e){
                 e.preventDefault();
                 var page_id=$(this).attr("id");
                 printTable(page_id);
               })


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
    $(document).on("keyup","#search",function(){
        var search=$(this).val();
        $.ajax({
             url: "search.php",
             type: "post",
             data: {search:search},
             success: function(data){
                 $("#tables").html(data);
             }
        });
    })


         
           });
        
        </script>
</html>