<?php $this->beginContent(); ?>

<div class="colmask">
    <div class="colleft">
        <div class="col1"> <!-- Column 1 (left) -->
            <?php echo $content; ?>
        </div>
        <div class="col2"> <!-- Column 2 (right)-->
            <?php foreach ($this->portlets as $class => $properties)
                $this->widget($class, $properties); ?>
        </div>
    </div>
</div>

<?php $this->endContent(); ?>
