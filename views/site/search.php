<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Search result by ' . $_GET['str'];
$this->registerMetaTag(['name' => 'description', 'content' => 'Search result by ' . $_GET['str']]);
if($_GET['page'] ?? false){
    $this->title .= ' - Page ' . $_GET['page'];
}
$this->params['breadcrumbs'][] = $this->title;

$tab = $_GET['tab'] ?? 'cpu';

?>
<div class="container mt-5 mb-5">

    <div class="tab-title">
        <div class="title">Search result</div>
        <ul class="my-tab nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation" id="cpu">
                <a class="nav-link <?= $tab == 'cpu' ? 'active' : '' ?>" id="opills-home-tab" data-toggle="pill" href="#opills-home" role="tab" aria-controls="pills-home" aria-selected="true">Processors (Cpu)</a>
            </li>
            <li class="nav-item" role="presentation" id="gpu">
                <a class="nav-link <?= $tab == 'gpu' ? 'active' : '' ?>" id="opills-profile-tab" data-toggle="pill" href="#opills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Video cards (GPU)</a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade <?= $tab == 'cpu' ? 'active show' : '' ?>" id="opills-home" role="tabpanel" aria-labelledby="pills-profile-tab">
            <?php if(!count($cpus)): ?>
                <div class="text-center mb-5">No results</div>
                <br><br><br>
                <br><br><br>
                <br><br><br>
                <br><br><br>
            <?php endif; ?>
            <div class="row" id="cpu">
                <?php foreach ($cpus as $cpu) : ?>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="review">
                            <img src="<?= $cpu->image ?>" alt="<?= $cpu->name ?>">
                            <span><?= $cpu->name ?></span>
                            <a href="<?= Url::to(['cpu/index', 'alias' => $cpu->alias]) ?>" class="btn btn-yellow">View</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-center">
                <?php echo LinkPager::widget([
                    'pagination' => $cpuPages,
                ]);  ?>
            </div>


        </div>

        <div class="tab-pane fade <?= $tab == 'gpu' ? 'active show' : '' ?>" id="opills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <?php if(!count($gpus)): ?>
                <div class="text-center">No results</div>
                <br><br><br>
                <br><br><br>
                <br><br><br>
                <br><br><br>
            <?php endif; ?>
            <div class="row" id="gpu">
                <?php foreach ($gpus as $gpu) : ?>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="review">
                            <img src="<?= $gpu->image_logo?>" alt="<?= $gpu->name ?>">
                            <span><?= $gpu->name ?></span>
                            <a href="<?= Url::to(['gpu/index', 'alias' => $gpu->alias]) ?>" class="btn btn-orange">View</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-center">
                <?php echo LinkPager::widget([
                    'pagination' => $gpuPages,
                ]);  ?>
            </div>
        </div>
    </div>

</div>

<?php

$js  = <<<JS

$('.my-tab .nav-item').click(function(){
    let tab = $(this).attr('id');
    console.log(tab)
    insertParam('tab', tab);
})

function insertParam(key, value) {
    key = encodeURIComponent(key);
    value = encodeURIComponent(value);

    // kvp looks like ['key1=value1', 'key2=value2', ...]
    var kvp = document.location.search.substr(1).split('&');
    let i=0;

    for(; i<kvp.length; i++){
        if (kvp[i].startsWith(key + '=')) {
            let pair = kvp[i].split('=');
            pair[1] = value;
            kvp[i] = pair.join('=');
            break;
        }
    }

    if(i >= kvp.length){
        kvp[kvp.length] = [key,value].join('=');
    }

    // can return this or...
    let params = kvp.join('&');

    // reload page with new params
    document.location.search = params;
}

JS;

$this->registerJs($js);

?>