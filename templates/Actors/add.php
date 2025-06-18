<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $actor
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Actors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="actors form content">
            <?= $this->Form->create($actor) ?>
            <fieldset>
                <legend><?= __('Add Actor') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('date_of_birth');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
