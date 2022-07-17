<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Form</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="display-1">Register</h1>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        form title
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Enter Text</label>
                                <input type="text" class="form-control" id="name_txt" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Address</label>
                                <textarea class="form-control" id="add_txt" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer"> <a href="#" class="btn btn-primary" id="button1">Go somewhere</a></div>
            </div>
        </div>
    </div>

    <span class="class1" id="id1">sdasdsads</span>

    <script>
    $(document).ready(function() {
        $("#button1").click(function() {
            //get data individually from form elements
            var a = $('#name_txt').val();
            var b = $('#add_txt').val();

            var dataString = 'name=' + a + '&add=' + b;

            $.ajax({
                type: "POST", // method action
                url: "test/mypost", // location server
                data: dataString, // data pipeline (json, urlencoded)
                cache: false, // url
                success: function(result) { // response after post action done
                    console.log(result);
                }
            });

        });


























    });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>