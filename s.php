<form action="s.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="">
    <input type="checkbox" name="ck[]" value="c">c
    <input type="checkbox" name="ck[]" value="c++">c++
    <input type="checkbox" name="ck[]" value="java">java
    <button name="save">Save</button>
</form>
<?php
if(isset($_POST['save']))
{

    foreach($_POST['ck'] as $ck)
    {
        echo $ck;
    }
}
?>