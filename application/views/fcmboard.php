


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script>
var url = "https://fcm.googleapis.com/fcm/send";
var device = '<?=$device_id;?>';
var xhr = new XMLHttpRequest();
xhr.open("POST", url);
xhr.setRequestHeader("Content-Type", "application/json,");
xhr.setRequestHeader("Authorization", "key=AAAAKE0Y9Nk:APA91bHRAerJRUkhyHk8ftUb6vUB2L02au3W0yVBLa6ZoK5MK3fDz6pMwQOIrZKAc7R5_zD_dJJfyeZx6YdY5akoTERv1XJ4jJcNL3FMXtC4u4Lj5KLGVb65MD6B9PuIxW3fm523viKO");
var data = '{"registration_ids":["'+device+'"],"notification": {"body": "Welcome s here","title": "DestiniGo","android_channel_id": "destinigo_admin"}}';
xhr.send(data);
xhr.onreadystatechange = function () {
   if (xhr.readyState === 4) {
    return true;  
    //xhr.responseText;
   }};
</script>    
</body>
</html>