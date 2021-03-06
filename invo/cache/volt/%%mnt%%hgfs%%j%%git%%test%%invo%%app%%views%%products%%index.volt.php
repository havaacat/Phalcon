
<?php echo $this->getContent(); ?>

<div align="right">
    <?php echo $this->tag->linkTo(array('products/new', 'Create Products', 'class' => 'btn btn-primary')); ?>
</div>

<?php echo $this->tag->form(array('products/search')); ?>

<h2>Search products</h2>

<fieldset>

<?php foreach ($form as $element) { ?>
    <?php if (is_a($element, 'Phalcon\Forms\Element\Hidden')) { ?>
<?php echo $element; ?>
    <?php } else { ?>
<div class="control-group">
    <?php echo $element->label(array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $element; ?>
    </div>
</div>
    <?php } ?>
<?php } ?>

<div class="control-group">
    <?php echo $this->tag->submitButton(array('Search', 'class' => 'btn btn-primary')); ?>
</div>

</fieldset>

</form>
