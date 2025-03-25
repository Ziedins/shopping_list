<div class="box">
    <h3>Edit item: <?php echo $item['name']; ?></h3>
    <form action="<?php echo URL; ?>api/updateItem/<?php echo $item['name']; ?>" method="POST">
        <input type="checkbox" name="checked" <?php echo ($item["checked"]) ? "checked" : ""; ?>/>
        <input type="submit"/>
    </form>
    <a href="<?php echo URL . '/shopping_list'; ?>" style="color: black;" >back</a>
</div>
