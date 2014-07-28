<?php require_once 'header.php'; ?>
        <div>
            <?php foreach ($this->unfollowedUsers as $user): ?>
                <div>
                    <?= $user->getName() ?> - <a href="<?= $this->urlGenerator->getAbsoluteUrl('user/follow') ?>/<?= $user->getId() ?>">Follow</a>
                </div>
            <?php endforeach; ?>
        </div>
        <div>
            <?php foreach ($this->followedUsers as $user): ?>
                <div>
                    <?= $user->getName() ?> - <a href="<?= $this->urlGenerator->getAbsoluteUrl('user/unfollow') ?>/<?= $user->getId() ?>">Unfollow</a>
                </div>
            <?php endforeach; ?>
        </div>
        </div>
    </body>
</html>