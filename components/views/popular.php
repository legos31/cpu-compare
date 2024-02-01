    <?php

    use yii\helpers\Url;

    ?>
    <div class="tab-title">
        <div class="title"><?=Yii::t('app','Popular comparisons')?></div>
        <ul class="my-tab nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><?=Yii::t('app','Processors (Cpu)')?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><?=Yii::t('app','Video cards (GPU)')?></a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
                <?php foreach ($cpus as $cpu) : ?>
                    <div class="col-xl-4 col-md-6">
                        <a href="<?= Url::to([$cpu->category_id == 1 ? 'cpu/compare' : 'gpu/compare', 'vs' => $cpu->card1->alias . '-vs-' . $cpu->card2->alias]) ?>" class="compare-card">
                            <div class="compare-card-body">
                                <div class="compare-card-left">
                                    <div>
                                        <img loading="lazy" src="<?= $cpu->card1->image_mini ?>" alt="<?= $cpu->card1->name ?>">
                                    </div>
                                    <span><?= $cpu->card1->name ?></span>
                                </div>
                                <div class="compare-card-right">
                                    <div>
                                        <img loading="lazy" src="<?= $cpu->card2->image_mini ?>" alt="<?= $cpu->card2->name ?>">
                                    </div>
                                    <span><?= $cpu->card2->name ?></span>
                                </div>
                                <div class="compare-card-icon"></div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row">
                <?php foreach ($gpus as $gpu) : ?>
                    <div class="col-xl-4 col-md-6">
                        <a href="<?= Url::to([$gpu->category_id == 1 ? 'cpu/compare' : 'gpu/compare', 'vs' => $gpu->card1->alias . '-vs-' . $gpu->card2->alias]) ?>" class="compare-card orange">
                            <div class="compare-card-body">
                                <div class="compare-card-left">
                                    <div>
                                        <img loading="lazy" src="<?= $gpu->card1->image_logo ?>" alt="<?= $gpu->card1->name ?>">
                                    </div>
                                    <span><?= $gpu->card1->name ?></span>
                                </div>
                                <div class="compare-card-right">
                                    <div>
                                        <img loading="lazy" src="<?= $gpu->card2->image_logo ?>" alt="<?= $gpu->card2->name ?>">
                                    </div>
                                    <span><?= $gpu->card2->name ?></span>
                                </div>
                                <div class="compare-card-icon"></div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>