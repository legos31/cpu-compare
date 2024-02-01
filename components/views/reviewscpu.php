<?php

use yii\helpers\Url;

?>

<div class="tab-title">
    <div class="title"><?=Yii::t('app', 'Reviews')?></div>
</div>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade active show" id="opills-all" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="row" id="cpu">
            <?php foreach ($cpus as $cpu) : ?>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="review">
                        <img loading="lazy" src="<?= $cpu->image ?>">
                        <span><?= $cpu->name ?></span>
                        <a href="<?= Url::to(['cpu/index', 'alias' => $cpu->alias]) ?>" class="btn btn-yellow"><?=Yii::t('app', 'View')?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="d-flex justify-content-center">
            <a href="#" class="show-more loader" data-id="cpu">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15">
                    <g opacity=".5">
                        <path d="M13.405 10.876c-.225-.171-.547-.127-.719.098-.032.044-.066.086-.1.129-.515.629-1.208 1.14-2.063 1.52l-.013.006c-1.348.644-2.927.732-4.44.249-1.33-.433-2.41-1.271-3.215-2.49-.597-.958-.91-1.998-.932-3.095v-.08h.629c.236 0 .355-.287.187-.454L1.597 5.616c-.104-.103-.272-.103-.376 0L.078 6.76c-.167.167-.048.453.188.453h.63c.008 1.324.376 2.576 1.093 3.724l.006.01c.935 1.422 2.2 2.4 3.76 2.908.748.238 1.51.357 2.26.357 1.02 0 2.018-.22 2.931-.654 1.069-.476 1.93-1.136 2.557-1.962.171-.226.128-.547-.098-.719zM15.73 7.107h-.63c0-.14-.005-.283-.013-.423-.065-1.108-.395-2.199-.954-3.155-.546-.932-1.31-1.741-2.21-2.34C11.008.582 9.948.19 8.858.06c-1.211-.147-2.443.02-3.562.48C4.2.991 3.223 1.719 2.473 2.646c-.178.22-.144.543.077.721.22.178.543.144.72-.076l.118-.14c.625-.727 1.416-1.3 2.299-1.664.957-.393 2.011-.536 3.048-.41.932.112 1.838.447 2.62.967.771.512 1.425 1.204 1.892 2.003.478.817.76 1.75.816 2.698.004.06.006.12.008.182l.003.18h-.63c-.237 0-.355.286-.188.453L14.4 8.703c.104.104.272.104.376 0l1.142-1.143c.168-.167.05-.453-.187-.453z" />
                    </g>
                </svg>

                <span><?=Yii::t('app', 'Show more')?></span>
            </a>
        </div>
    </div>

</div>


<?php

$js = <<<JS

let k = 2;
$('.loader').click(function(e){
    e.preventDefault();
    let id = $(this).attr('data-id')
    let elem = $(this)

    elem.children('span').text('loading...')
    $.get('/' + id + '/reviews?page=' + k, (res) => {
        console.log(res);
        elem.children('span').text('Show more')
        k++;

        for(let card of res){
            let imageCpuGpu = card.category_id == 1 ? card.image : card.image_logo;
            let col = createElem('div', '', {class: 'col-xl-3 col-lg-4 col-sm-6'})
            let review = createElem('div', '', {class: 'review'})
                createElemIn(review, 'img', '', {src: imageCpuGpu, alt: card.name})
                createElemIn(review, 'span', card.name)
                createElemIn(review, 'a', 'View', {class: 'btn ' + (card.category_id == 1 ? 'btn-yellow' : 'btn-orange'), href: '/'+(card.category_id == 1 ? 'cpu' : 'gpu')+'/'+card.alias})
            add(col, review)
            $('#'+id).append(col)
        }
    })

})

JS;

$this->registerJs($js);


?>