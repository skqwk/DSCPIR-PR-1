<table>
    <tr><th>Id</th><th>Login</th></tr>
<?php
foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['login']}</td></tr>";
}
?>
</table>

<hr>
<form method="post" action="index/session">
<input type="submit" name="switch"
                class="button" value="Theme switch" />
</form>

<form method="post" action="index/session">
<input type="text" name="username" value="<?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : "" ?>"/>
<input type="submit" name="setname"
                class="button" value="Set name" />
</form>

<form method="post" action="index/session">
<label for="selected-favicon">Select weather</label>
<select name="icon" id="selected-favicon">
    <?php
    foreach ($icons as $icon) {
        echo "<option value=\"{$icon['file']}\">{$icon['name']}</option>";
    }
    ?>
</select>
<input type="submit" value="Set icon">
</form>
