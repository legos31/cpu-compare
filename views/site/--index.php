<?php

/* @var $this yii\web\View */

$this->title = $page->meta['title'];
$this->registerMetaTag(['name' => 'description', 'content' => $page->meta['description']]);
?>



<div class="container">

    <?= app\components\LatestCompareWidget::widget() ?>

    <div class="row">
        <div class="col-xl-9">
            <div class="row">
                <div class="col-md-6">
                    <div class="title">
                        <img src="images/icons/cpu.svg" alt="cpu">
                        Processors (Cpu)
                    </div>

                    <?php if (count($cpu->top10)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <img src="images/icons/top.svg" alt="top">
                                Top 10 processors
                            </div>
                            <div class="box-body">
                                <?php foreach ($cpu->top10 as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                                <span><?= $card->name ?></span>
                                            </div>
                                            <span><?= $card->score ?>%</span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($cpu->bestProcessor)) : ?>
                        <div class="box">
                            <div class="box-title">
                                Best Integrated Processor
                            </div>
                            <div class="box-subtitle">
                                Fire Strike and CompuBench OpenCL benchmarks
                            </div>
                            <div class="box-body">
                                <?php foreach ($cpu->bestProcessor as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                                <span><?= $card->name ?></span>
                                            </div>
                                            <span><?= $card->score ?>%</span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($cpu->bestScore)) : ?>
                        <div class="box">
                            <div class="box-title">
                                Better overall performance
                            </div>
                            <div class="box-subtitle">
                                CPU and iGPU benchmarks
                            </div>
                            <div class="box-body">
                                <?php foreach ($cpu->bestScore as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                                <span><?= $card->name ?></span>
                                            </div>
                                            <span><?= $card->score ?>%</span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($cpu->bestPrice)) : ?>
                        <div class="box">
                            <div class="box-title">
                                The best processors in terms of price-quality ratio
                            </div>
                            <div class="box-subtitle">
                                Fire Strike and CompuBench OpenCL benchmarks
                            </div>
                            <div class="box-body">
                                <?php foreach ($cpu->bestPrice as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                                <span><?= $card->name ?></span>
                                            </div>
                                            <span><?= $card->score ?>%</span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($cpu->populars)) : ?>
                        <div class="box">
                            <div class="box-title">
                                Popular processors
                            </div>
                            <div class="box-subtitle">
                                CPU and iGPU benchmarks
                            </div>
                            <div class="box-body">
                                <?php foreach ($cpu->populars as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'yellow' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                                <span><?= $card->name ?></span>
                                            </div>
                                            <span><?= $card->score ?>%</span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
                <div class="col-md-6">
                    <div class="title">
                        <img src="images/icons/cpu-orange.svg" alt="gpu">
                        Video cards (GPU)
                    </div>

                    <?php if (count($gpu->top10)) : ?>
                        <div class="box">
                            <div class="box-title">
                                <img src="images/icons/top.svg" alt="top">
                                Top 10 video cards
                            </div>
                            <div class="box-body">
                                <?php foreach ($gpu->top10 as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                                <span><?= $card->name ?></span>
                                            </div>
                                            <span><?= $card->score ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($gpu->bestProcessor)) : ?>
                        <div class="box">
                            <div class="box-title">
                                Best integrated video card
                            </div>
                            <div class="box-subtitle">
                                Fire Strike and CompuBench OpenCL benchmarks
                            </div>
                            <div class="box-body">
                                <?php foreach ($gpu->bestProcessor as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                                <span><?= $card->name ?></span>
                                            </div>
                                            <span><?= $card->score ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($gpu->bestScore)) : ?>
                        <div class="box">
                            <div class="box-title">
                                Better overall performance
                            </div>
                            <div class="box-subtitle">
                                CPU and iGPU benchmarks
                            </div>
                            <div class="box-body">
                                <?php foreach ($gpu->bestScore as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                                <span><?= $card->name ?></span>
                                            </div>
                                            <span><?= $card->score ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($gpu->bestPrice)) : ?>
                        <div class="box">
                            <div class="box-title">
                                The best video cards in terms of price-quality ratio
                            </div>
                            <div class="box-subtitle">
                                Fire Strike and CompuBench OpenCL benchmarks
                            </div>
                            <div class="box-body">
                                <?php foreach ($gpu->bestPrice as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                                <span><?= $card->name ?></span>
                                            </div>
                                            <span><?= $card->score ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (count($gpu->populars)) : ?>
                        <div class="box">
                            <div class="box-title">
                                Popular video cards
                            </div>
                            <div class="box-subtitle">
                                CPU and iGPU benchmarks
                            </div>
                            <div class="box-body">
                                <?php foreach ($gpu->populars as $key => $card) : ?>
                                    <div class="progress my-progres <?= $key < 3 ? 'orange' : '' ?>">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $card->score ?>;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="95">
                                            <div>
                                                <img src="<?= $card->image_mini ?>" alt="<?= $card->name ?>">
                                                <span><?= $card->name ?></span>
                                            </div>
                                            <span><?= $card->score ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>


    <!-- Популярные сравнения -->
    <?= app\components\PopularCompareWidget::widget() ?>
    <!-- Популярные сравнения -->

    <!-- Обзоры -->
    <?= app\components\ReviewsWidget::widget() ?>
    <!-- Обзоры -->

    <!-- О сайте -->
    <div class="about">
        <div class="title">About project</div>

        <div class="row">
            <div class="col-md-6">
                This service uses a conditional system for evaluating the performance of the CPU and GPU. Data on
                 ARM performance
                 processors were taken from a variety of sources, mainly based on the results of such tests,
                 how:
                 PassMark, Antutu, GFXBench.
            </div>
            <div class="col-md-6">
                We do not claim absolute accuracy. Rank and measure performance with absolute precision
                 ARM
                 processors
                 impossible, for the simple reason that each of them, in some way has advantages, and in some way
                 lags behind
                 from other ARM
                 processors.
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <a href="#" class="show-more">
                <span>Show more</span>
            </a>
        </div>
    </div>
    <!-- О сайте -->

</div>