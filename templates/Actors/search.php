<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Actor> $actors
 */
?>
<div class="actors index content">
    <h3><?= __('Search') ?></h3>

    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <?= $this->Form->control('q', ['label' => 'Name', 'value' => $searchTerm ?? '', 'placeholder' => 'Search for an actor...']) ?>
    <?= $this->Form->submit('Search') ?>
<?= $this->Form->end() ?>

<?php if (!empty($searchResults)): ?>
    <h2>Results</h2>
    <ul>
        <?php foreach ($searchResults as $person): ?>
            <li style="margin-bottom: 20px;">
                <strong><?= h($person['name']) ?></strong> (<?= h($person['known_for_department']) ?>)
                <br>

                <?php if (!empty($person['profile_path'])): ?>
                    <img src="https://image.tmdb.org/t/p/w185<?= h($person['profile_path']) ?>" alt="<?= h($person['name']) ?>" style="max-height: 200px;">
                    <br>
                <?php endif; ?>

                <strong>Popularity:</strong> <?= h($person['popularity']) ?><br>
                <strong>Gender:</strong> <?= $person['gender'] === 1 ? 'Female' : ($person['gender'] === 2 ? 'Male' : 'Unknown') ?><br>
                <strong>Adult Content:</strong> <?= $person['adult'] ? 'Yes' : 'No' ?><br>

                <?php if (!empty($person['known_for'])): ?>
                    <strong>Known For:</strong>
                    <ul>
                        <?php foreach ($person['known_for'] as $work): ?>
                            <li>
                                <?= h($work['title'] ?? $work['name'] ?? 'Untitled') ?>
                                (<?= ucfirst($work['media_type']) ?>)
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php elseif (!empty($searchTerm)): ?>
    <p>No results found.</p>
<?php endif; ?>
</div>