<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use lawiet\rbac\web\Access;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::t('app', 'My Company') ?> - <?= Html::encode($this->title) ?></title>
    <script> var $pathHome = '<?= Url::to(['/']) ?>' </script>
    <?php $this->head() ?>
</head>
<body class="fixeds">
<?php $this->beginBody() ?>

<div class="wrap">
    <header class="header">
        <div class="img-company">
            <div class="logo-left pull-left">
                <?= Html::img('@web/images/logo-left.png', ['class'=>'responsive', 'alt'=>'logo']);?>
            </div>
            <div class="logo-right pull-right">
                <?= Html::img('@web/images/logo-right.png', ['class'=>'responsive', 'alt'=>'logo']);?>
            </div>
        </div>

        <div class="menu">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::t('app', 'My Company'),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
			echo Nav::widget(Access::getPrincipalMenu());
            NavBar::end();
            ?>
        </div>
    </header>

    <div class="container content">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }?>
        <?= $content ?>
        <br />
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Yii::t('app', 'company development') ?> <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::t('app', 'Yii powered') ?></p>
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
