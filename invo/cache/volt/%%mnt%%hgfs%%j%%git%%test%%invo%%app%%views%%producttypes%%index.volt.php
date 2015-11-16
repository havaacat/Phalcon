<?php echo $this->getContent(); ?>

<div align="right">
    <?php echo $this->tag->linkTo(array('producttypes/new', 'Create product types', 'class' => 'btn btn-primary')); ?>
</div>

<?php echo $this->tag->form(array('producttypes/search', 'autocomplete' => 'off')); ?>

<div class="center scaffold">

    <h2>Search product types</h2>

    <div class="clearfix">
        <label for="id">Id</label>
        <?php echo $this->tag->numericField(array('id', 'size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="clearfix">
        <label for="name">Name</label>
        <?php echo $this->tag->textField(array('name', 'size' => 24, 'maxlength' => 70)); ?>
    </div>

    <div class="clearfix">
        <?php echo $this->tag->submitButton(array('Search', 'class' => 'btn btn-primary')); ?>
    </div>

</div>

</form>
