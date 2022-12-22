<html>
    <head>
    <link rel="stylesheet" href="Css/bootstrap.min.css" />
    </head>
</html>
<?php 


$newcomer[] = array_merge($_POST);
$newcomer_name = $_POST["username"];

if(!empty($newcomer)){
    if(file_exists("newcomer.json")){
        $json = file_get_contents("newcomer.json");
        $json_Array = json_decode($json, true);
    } else {
        $json_Array = [];
    }

    $json_Array[$newcomer_name] = $newcomer;
    file_put_contents("newcomer.json", json_encode($json_Array, JSON_PRETTY_PRINT));
    echo"<div class='alert alert-success text-center'>Registration Done</div>";
    header("refresh:1;url=index.php");
}else{
    echo"<div class='alert alert-danger text-center'>Error !!!</div>";
    header("refresh:1;url=index.php");
}
// header("location: index.php");
?>