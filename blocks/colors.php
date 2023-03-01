<?php
    $title = "Задача про цвет шрифта и фона";
    require "./header.php";
?>
<div class="container mt-2">
    <form method="POST">
        <div>Введите значение от 0 до 255 в каждое поле:</div><br>
        <input type="text" name="red" placeholder="Введите значение" class="form-control"><br>
        <input type="text" name="green" placeholder="Введите значение" class="form-control"><br>
        <input type="text" name="blue" placeholder="Введите значение" class="form-control"><br>
        <input type="submit" value="Accept" class="btn btn-success"><br>
    </form>
    </div>
    <?php
    $r = "";
    $g = "";
    $b = "";

    if(!empty($_POST['red']) && !empty($_POST['green']) && !empty($_POST['blue'])) {
    $r = $_POST['red'];
    $g = $_POST['green'];
    $b = $_POST['blue'];
    }

    $rc = rand(0,255);
    $gc = rand(0,255);
    $bc = rand(0,255);

    function AddColor($r, $g, $b, $rc, $gc, $bc)
    {
    echo '<br>';
    echo "<h1 style='background-color: rgb(".$r.','.$g.','.$b."); color: rgb(".$rc.','.$gc.','.$bc.");'>Text Text Text !!!</h1>";
    }                                      
    AddColor($r, $g, $b, $rc, $gc, $bc );
    ?>
    
    <?php
    require_once "./footer.php";
    ?>