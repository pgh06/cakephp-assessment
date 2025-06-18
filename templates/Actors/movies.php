<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Actor> $actors
 */
?>
<div class="actors index content">
    <h3><?= __('Movies') ?></h3>
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <fieldset>
        <legend><?= __('Filter by Actor') ?></legend>
        <?= $this->Form->control('name', [
            'label' => false,
            'placeholder' => 'Enter actor name',
            'value' => $this->request->getQuery('name'),
        ]) ?>
    </fieldset>
    <?= $this->Form->button(__('Filter')) ?>
    <?= $this->Form->end() ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('date_of_birth') ?></th>
                    <th><?= __('Movies') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($actors as $actor): ?>
                <tr>
                    <td><?= h($actor->name) ?></td>
                    <td><?= h($actor->date_of_birth) ?></td>
                    <td>
                        <?php if (!empty($actor->movies)): ?>
                            <ul>
                                <?php foreach ($actor->movies as $movie): ?>
                                    <li><?= h($movie->name) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <em>No movies</em>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>