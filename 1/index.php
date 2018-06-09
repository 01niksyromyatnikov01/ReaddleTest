<?php
require_once 'autoload.php';
$Autoload = new Autoload();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>Currency converter</title>
</head>
<body>
<?php
$API = new Requests\API();
$Ex = new Currency\Exchange($API);

$converted_to = '';
$original_value = '0';
if(isset($_POST['currency']) AND isset($_POST['original_value'])) {
    $value =  $Ex->Convert($_POST['original_value'],$_POST['currency']);
    $converted_to = $_POST['currency'];
    $original_value = $_POST['original_value'];
}
?>


<form action="index.php" method="post">
    <div class="row col-md-5 center-block" style="float:none;margin:0 auto;background: #efeded3d;padding: 20px;border: 1px solid #dad5d58f;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px ">
        <div class="col">
            <input type="text" name="from_currency" maxlength="3" class="form-control" value="USD to" readonly required>

        </div>
        <div class="col">
            <input type="text" name="currency" maxlength="3" class="form-control" placeholder="Currency" value="<?php echo $converted_to; ?>" required>
        </div>
        <div class="col">
            <input type="text" class="form-control" maxlength="12" placeholder="Value" name="original_value" value="<?php echo $original_value; ?>" required>
        </div>
        <div class="col">
            <input type="submit" class="btn btn-outline-primary" value="Convert">
        </div>
        <div class="col">
            <input type="text" class="form-control" maxlength="15" value="<?php echo $value; ?>">
        </div>
    </div>
</form>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>



