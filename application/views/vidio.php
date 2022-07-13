<!doctype html>
<html lang="en">

<head>
    <title>Play Video</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body style="background-color: #060038;" class="pt-5 ps-2 pe-2">
    <script type="text/javascript">
    atOptions = {
        'key': '981fb3a44e32dd9fcd4bb84ffe026f60',
        'format': 'iframe',
        'height': 60,
        'width': 468,
        'params': {}
    };
    document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') +
        '://www.effectivedisplaycontent.com/981fb3a44e32dd9fcd4bb84ffe026f60/invoke.js"></scr' + 'ipt>');
    </script>
    <?
$code=$this->input->get('uri');
if(empty($code)){
    redirect('https://www.google.com/');

}else{
    $fnd_code=$this->query->finder(array('rand'=>$code),'vid_link_tbl');
    if($fnd_code){
        if($fnd_code->row()->status=='1'){
        ?>
    <center>
        <!-- <div style="width:100%;height:0px;position:relative;padding-bottom:55.000%;"><iframe
                src="https://streamable.com/e/3tskvr?autoplay=1" frameborder="0" width="100%" height="100%"
                allowfullscreen allow="autoplay"
                style="width:100%;height:100%;position:absolute;left:0px;top:0px;overflow:hidden;"></iframe></div>
        -->
        <video controls autoplay=true; width="100%" height="100%" controlsList="nodownload">
            <source id="myVideo" src="https://play.liveipl.online/vids/ee.mp4" type="video/mp4"
                controlsList="nodownload" autoplay=true;>
        </video>
    </center>
    <?
    //http://play.liveipl.online/?uri=fCLGLw5P75
        }else{

            redirect('https://www.google.com/');
        }
    }else{
       redirect('https://www.google.com/');
    }
}
?>
    <script>
    $(document).ready(function() {
        var rand = '<?=$code?>';
        var datastring = {
            rand: rand,
        };
        if (rand == '') {
            $("#other_modal").modal('show');
            $('#message_alert').html('Id is empty ...!');
        } else {
            $.ajax({
                url: "<?=base_url();?>play/store_res/",
                dataType: 'json',
                method: "POST",
                data: datastring,
                catch: false,
                success: function(data) {
                    if (data.err == '1') {} else if (data.err == '0') {
                        $("#other_modal").modal('show');
                        $('#message_alert').html('Error In Playing');
                    } else {
                        $("#other_modal").modal('show');
                        $('#message_alert').html('Error In Playing');
                    }
                }
            });
        }

    });
    </script>
    <!-- ads -->
    <script async="async" data-cfasync="false"
        src="//pl17041117.trustedcpmrevenue.com/b20680f1f8044aeb75478280cc943aa5/invoke.js"></script>
    <div id="container-b20680f1f8044aeb75478280cc943aa5"></div>
    <script type='text/javascript'
        src='//pl17041132.trustedcpmrevenue.com/8c/9e/28/8c9e28d8b4d5691350eb11d98a91167d.js'></script>
</body>
</html>
