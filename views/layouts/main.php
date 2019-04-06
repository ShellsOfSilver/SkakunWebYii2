<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\PublicAsset;
use app\assets\AppAsset;
use app\models\Comment;
use app\models\Article;
use app\models\User;
use app\models\Category;

PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
<body>
<?php $this->beginBody() ?>

    <nav class="navbar main-menu navbar-default">
        <div class="container">
            <div class="menu-content">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="/Web/yii/SkakunWeb/web/public/images/logo.png"
                                                                   alt="asd"></a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav text-uppercase">
                        <li><a data-toggle="dropdown" class="dropdown-toggle" href="index.html">Home</a>

                        </li>
                    </ul>
                    <div class="i_con">
                        <ul class="nav navbar-nav text-uppercase">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <li><a href="<?= Url::toRoute(['auth/login']) ?>">Login</a></li>
                                <li><a href="<?= Url::toRoute(['auth/signup']) ?>">Register</a></li>
                            <?php else: ?>
                                <?= Html::beginForm(['auth/logout'], 'post') .
                                Html::a(Html::img('@web/uploads/' . Yii::$app->user->identity->photo,
                                    ['alt' => 'Profile', 'width' => 50, 'class' => 'img-circle']),
                                    ['/auth/view', 'id' => Yii::$app->user->identity->id, ['class' => 'btn']]) .
                                Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->name . ')',
                                    ['class' => 'btn btn-link logout', 'style' => 'padding-top:10px']
                                ) .
                                Html::endForm() ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                </div>
                <!-- /.navbar-collapse -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>


<?= $content ?>


    <footer class="footer-widget-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <aside class="footer-widget">
                        <div class="about-img"><img src="/Web/yii/SkakunWeb/web/public/images/logo2.png" alt=""></div>
                        <div class="about-content" align="justify">Lorem ipsum dolor sit amet, consetetur sadipscing
                            elitr,
                            sed diam nonumy
                            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed voluptua. At vero eos et
                            accusam et justo duo dlores et ea rebum magna text ar koto din.
                        </div>
                        <div class="address">
                            <h4 class="text-uppercase">contact Info</h4>

                            <p> 14529/12 NK Streets, DC, KZ</p>

                            <p> Phone: +123 456 78900</p>

                            <p>mytreasure.com</p>
                        </div>
                    </aside>
                </div>

                <div class="col-md-4">
                    <aside class="footer-widget">
                        <h3 class="widget-title text-uppercase">RECENT COMMENTS</h3>
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!--Indicator-->
                             <?php $countComment = 3;$comments = Comment::getRecentComment($countComment); ?>
                              <ol class="carousel-indicators">
                               <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                 <?php for ($i = 1; $i < count($comments); $i++): ?>
                                  <li data-target="#myCarousel" data-slide-to="<?=$i;?>"></li>
                                  <?php endfor; ?>
                              </ol>


                            <div class="carousel-inner" role="listbox">
                                <?php if (!empty($comments)):?>
                            <?php for ($i = 0;$i < count($comments);$i++): ?>

                            <?php if ($i == 0): ?>
                                <div class="item active">
                                    <?php else: ?>
                                    <div class="item">
                                        <?php endif; ?>
                                        <div class="single-review">
                                            <div class="review-text">
                                                <p><?= $comments[$i]->text; ?></p>
                                            </div>
                                            <div class="author-id">
                                                <?= Html::img('@web/uploads/' . (User::find()->where(['id' => $comments[$i]->user->id])->one())->getImage(),
                                                    ['alt' => 'Profile', 'width' => 50, 'class' => 'img-circle']) ?>
                                                <div class="author-text">
                                                    <h4><?= $comments[$i]->user->name; ?></h4>

                                                    <h4>
                                                        <a href="<?= Url::toRoute(['site/category','id'=>$comments[$i]->article->category->id]) ?>">
                                                            <?= $comments[$i]->article->category->title; ?>,
                                                        </a>
                                                        <a href="<?= Url::toRoute(['site/view','id'=>$comments[$i]->article->id]) ?>">
                                                            <?= $comments[$i]->article->title; ?>
                                                        </a>

                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endfor; ?>
                                    <?php else: ?>

                                        <div class="item active">

                                            <div class="single-review">
                                                <div class="review-text">
                                                    <p>Your comment</p>
                                                </div>
                                                <div class="author-id">
                                                    <?= Html::img('@web/noImage.png' ,
                                                        ['alt' => 'Profile', 'width' => 50, 'class' => 'img-circle']) ?>
                                                    <div class="author-text">
                                                        <h4>User</h4>
                                                        <h4>Category, Article Title</h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    <?php endif; ?>
                                </div>
                    </aside>
                </div>

                <div class="col-md-4">
                    <aside class="footer-widget">
                        <h3 class="widget-title text-uppercase">Custom Post</h3>
                        <div class="custom-post">
                            <div>
                                <?php $article = Article::getRandom(); ?>
                                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]); ?>">
                                    <img src="<?= $article->getImage(); ?>" alt=""></a>
                            </div>
                            <div>
                                <a href="<?= Url::toRoute(['site/view', 'id' => $article->id]); ?>"
                                   class="text-uppercase"><?= $article->title; ?></a>
                                <span class="p-date"><?= $article->getDate(); ?></span>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
        <div class="footer-copy">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">&copy; 2019 <a href="#">Treasure PRO, </a> Built with <i
                                    class="fa fa-heart"></i> by <a href="#">Skakun 303</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>

<?php $this->endPage() ?>