<html>
    <head>
        <title><?= $this->title ?></title>
        <script src="<?= $this->urlGenerator->getAbsoluteUrl('public/js/jquery-1.7.1.min.js') ?>"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php foreach ($this->menu as $menuItem): ?>
                <li <?= isset($menuItem['active']) ? 'class="active"' : '' ?>>
                    <a href="<?= $menuItem['link'] ?>"><?= $menuItem['text'] ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>