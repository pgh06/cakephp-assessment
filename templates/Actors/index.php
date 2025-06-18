<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Actor> $actors
 */
?>
<div class="actors index content">
    <?= $this->Html->link(__('New Actor'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Actors') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('date_of_birth') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($actors as $actor): ?>
                <tr>
                    <td><?= $this->Number->format($actor->id) ?></td>
                    <td><?= h($actor->name) ?></td>
                    <td><?= h($actor->date_of_birth) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $actor->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $actor->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $actor->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $actor->id),
                            ]
                        ) ?>
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