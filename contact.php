<?php
$con=new mysqli($servername,$username,$password,$dbnname);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username= htmlspecialchars($_POST['username']);
    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $message= $_POST['msg'];
$sql="INSERT Into (db name) values('','$username','$email','$phone','$message')";
$result = $con->query($sql);
echo '<script>
    alert("Vos données ont été enregistrées avec succès !");
    setTimeout(function() {
        window.location.href = "contact.html";
    }, 1500);
</script>';
}
?>
