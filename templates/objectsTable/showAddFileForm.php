<?php
echo $URL;
?>

<form action="<?=$URL?>" method="POST" class="text-center border border-success p-3">
  <div class="form-group">
    <label for="exampleFormControlFile1">Добавление файла к объекту:</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" style="margin-left: 45%;">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>