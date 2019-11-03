<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col-7 border border-primary bg-secondary">
            <?php
                echo "<h2>Данные об объекте:</h2>";
                foreach ($objectHeaders as $headersName => $value) {
                    if ($headersName != 'id_customer' && $headersName != 'status_objects') {
                        echo "<div><h4>$value</h4>".$objectInfo[0][$headersName]."</div>";
                    }
                }
                echo "<div><h4>".$statusObjectsHeaders['status_objects']."</h4>".$statusObjectsInfo[0]['status_objects']."</div>";

                if ($deleteEditAccess) {
                    echo "<a href='?t=" . $controllerName . "&a=ShowEditForm&id=" .$_GET['id'] . "' class='btn btn-warning'>Edit</a>";
                    echo "<a href='?t=" . $controllerName . "&a=Delete&id=" . $_GET['id'] . "' class='btn btn-danger'>Delete</a>";
                }
                
            ?>
        </div>
        <div class="col-3 border border-primary bg-secondary">
            <?php
                echo "<h2>Данные о заказчике объекта:</h2>";
                foreach ($customerHeaders as $headersName => $value) {
                    if ($headersName != 'id') {
                        echo "<div><h4>$value</h4>".$customerInfo[0][$headersName]."</div>";
                    }
                }
            ?>
        </div>
        <div class="col"></div>
    </div>
</div>



<!-- Файлообменик -->
<div class="container-fluid border border-primary bg-info mt-5">
<form action="<?=$URL?>" method="post" enctype="multipart/form-data">
    <div class='container-fluid'>
        <div class='row justify-content-center'>
            <div class='col-8'>
            <div class="form-group">
                <label for="exampleFormControlFile1">Добавление файла к объекту:</label>
                <input type="file" name="AddFile" class="form-control-file" id="exampleFormControlFile1">
            </div>  
                <?php if ($deleteEditAccess) {
                        echo "<button type='submit' class='btn btn-primary'>Добавить!</button>";
                    }
                ?>
            </div>
        </div>
    </div>
</form>


<h3>Доступные файлы по объекту:</h3>
<?php
    foreach ($files as $filesData) {
        foreach ($filesData as $key => $value) {
            if ($key == 'name_file') {
                echo "<a href=".$URLDownLoad.'&id_file='.$filesData['id'].">".$value."</a><br>";
            }
        }
    }

?>

</div>