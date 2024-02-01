<?php

use yii\helpers\Url;

?>
<!-- header -->
<header class="header">
    <div class="container">
        <!-- top navigation -->
        <div class="top-nav ">
            <div class="d-flex align-items-center top-nav-left">
                <div class="logo">
                    <a href="<?= Url::home() ?>"><img src="/images/logo-cpucompare.png" alt="Logo" /></a>
                </div>
                <!-- menu -->
                <div class="menu">
                    <div class="menu-item">
                        <a href="#" class="menu-link dropdown">
                            <?= Yii::t('app', 'Processors') ?>
                            <i class="arrow down"></i>
                        </a>
                        <div class="menu-dropdown">
                            <div class="menu-item">
                                <a href="<?= Yii::$app->urlManager->createUrl('cpu') ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Processors comparison') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['cpu/family']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'CPUs groups') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/total']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Overall ranking CPUs') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/geekbench5']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Geekbench 5 processor rankings') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/igpu']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'iGPU processor rankings') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/cinebenchr23']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Cinebench R23 processor rankings') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/cinebenchr20']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Cinebench R20 processor rankings') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/cinebenchr15']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Cinebench R15 processor rankings') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/passmark']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'PassMark processor rankings') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/monero']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Monero processor rankings') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="#" class="menu-link dropdown">
                            <?= Yii::t('app', 'Graphics cards') ?>
                            <i class="arrow down"></i>
                        </a>
                        <div class="menu-dropdown">
                            <div class="menu-item">
                                <a href="<?= Yii::$app->urlManager->createUrl('gpu') ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Graphics Cards comparison') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['gpu/family']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'GPUs groups') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/total-gpu']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Overall GPU performance ranking') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/fp32']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Graphics Card Rating - FP32') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/3dmark']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Graphics Card Rating - 3DMark') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/battlefield5']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Graphics Card Rating - Battlefield 5') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/shadow-tomb-raider']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Graphics Card Rating - Shadow of the Tomb Raider') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/ethereum']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Graphics Card Rating - Ethereum Hashrate') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/ergo']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Graphics Card Rating - Ergo Hashrate') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/ravencoin']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Graphics Card Rating - Ravencoin Hashrate') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['benchmark/vertcoin']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Graphics Card Rating - Vertcoin Hashrate') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['gpu/list', 'brand' => 9, 'score' => '']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'Nvidia rating') ?>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['gpu/list', 'brand' => 2, 'score' => '']) ?>" class="menu-dropdown-link">
                                    <?= Yii::t('app', 'AMD rating') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a href="<?= Url::to(['site/about']) ?>" class="menu-link"><?= Yii::t('app', 'About the site') ?></a>
                    </div>
                </div>
                <!-- menu -->

                <!-- mobile menu -->
                <div class="menu mobile">
                    <div class="menu-item">
                        <a href="#" class="menu-link dropdown" id="toggle-menu">
                            <?= Yii::t('app', 'Menu') ?>
                            <i class="arrow down"></i>
                        </a>
                        <div class="menu-dropdown">
                            <div class="menu-item">
                                <a href="#" class="menu-dropdown-link dropdown">
                                    <?= Yii::t('app', 'Processors') ?>
                                    <i class="arrow right"></i>
                                </a>
                                <div class="menu-dropdown">
                                    <div class="menu-item menu-back">
                                        <a href="#" class="menu-dropdown-link">
                                            <i class="arrow left"></i>
                                            <?= Yii::t('app', 'Processors') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Yii::$app->urlManager->createUrl('cpu') ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Processors comparison') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/total']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Overall ranking CPUs') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/geekbench5']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Geekbench 5 processor rankings') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/igpu']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'iGPU processor rankings') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/cinebenchr23']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Cinebench R23 processor rankings') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/cinebenchr20']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Cinebench R20 processor rankings') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/cinebenchr15']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Cinebench R15 processor rankings') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/passmark']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'PassMark processor rankings') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/monero']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Monero processor rankings') ?>
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="menu-item">
                                <a href="#" class="menu-dropdown-link dropdown">
                                    <?= Yii::t('app', 'Video cards') ?>
                                    <i class="arrow right"></i>
                                </a>
                                <div class="menu-dropdown">
                                    <div class="menu-item menu-back">
                                        <a href="#" class="menu-dropdown-link">
                                            <i class="arrow left"></i>
                                            <?= Yii::t('app', 'Video cards') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Yii::$app->urlManager->createUrl('gpu') ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Graphics Cards comparison') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/total-gpu']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Overall GPU performance ranking') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/fp32']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Graphics Card Rating - FP32') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/3dmark']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Graphics Card Rating - 3DMark') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/battlefield5']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Graphics Card Rating - Battlefield 5') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/shadow-tomb-raider']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Graphics Card Rating - Shadow of the Tomb Raider') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/ethereum']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Graphics Card Rating - Ethereum Hashrate') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/ergo']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Graphics Card Rating - Ergo Hashrate') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/ravencoin']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Graphics Card Rating - Ravencoin Hashrate') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['benchmark/vertcoin']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Graphics Card Rating - Vertcoin Hashrate') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['gpu/list', 'brand' => 9, 'score' => '']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'Nvidia rating') ?>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?= Url::to(['gpu/list', 'brand' => 2, 'score' => '']) ?>" class="menu-dropdown-link">
                                            <?= Yii::t('app', 'AMD rating') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-item">
                                <a href="<?= Url::to(['site/about']) ?>" class="menu-dropdown-link"><?= Yii::t('app', 'About the site') ?></a>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- mobile menu -->

            </div>
            <div class="d-flex align-items-center top-nav-right">


                <?= \app\components\LanguageKslSwitcher::widget() ?>



                <form action="<?= Url::to(['site/search']) ?>" class="search">
                    <input type="text" name="str" required placeholder="<?= Yii::t('app', 'Search') ?>" autocomplete="off">
                    <button type="submit" class="search-submit"></button>
                    <button type="button" class="search-close"></button>
                </form>
                <div class="search-show"></div>
            </div>
        </div>
        <!-- top navigation -->

        <!-- compare form -->
        <div class="tab-form">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $active_tab == 'gpu' ? '' : 'active' ?>" id="home-tab" data-toggle="tab" href="#processors" role="tab" aria-controls="home" aria-selected="true"><?= Yii::t('app', 'CPU') ?> </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $active_tab == 'gpu' ? 'active' : '' ?>" id="profile-tab" data-toggle="tab" href="#video-cards" role="tab" aria-controls="profile" aria-selected="false"><?= Yii::t('app', 'GPU') ?> </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade <?= $active_tab == 'gpu' ? '' : 'show active' ?>" id="processors" role="tabpanel" aria-labelledby="processors-tab">
                    <form action="#" class="position-relative" id="cpu-compare">
                        <div class="row">
                            <div class="col-md-6">
                                <?php if ($card1 && $active_tab == 'cpu') : ?>
                                    <div class="tab-form-autocomplete autocomplete">
                                        <input name="alias" type="hidden" class="processor-id" value="<?= $card1->alias ?>">
                                        <div class="autocomplete-image mr-3" style="background-image: url('<?= $card1->image_mini ?>')"></div>
                                        <input type="text" class="autocomplete-input typing" value="<?= $card1->name ?>" data-type="cpu">
                                        <span class="autocomplete-placeholder"><?= $card1->name ?></span>

                                        <div class="autocomplete-dropdown">
                                            <div class="autocomplete-dropdown-scroll">
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="tab-form-autocomplete autocomplete">
                                        <input name="alias" type="hidden" class="processor-id">
                                        <div class="autocomplete-image mr-3"></div>
                                        <input type="text" class="autocomplete-input typing" data-type="cpu">
                                        <span class="autocomplete-placeholder"><?= Yii::t('app', 'Select processor 1') ?></span>

                                        <div class="autocomplete-dropdown">
                                            <div class="autocomplete-dropdown-scroll">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <?php if ($card2 && $active_tab == 'cpu') : ?>
                                    <div class="tab-form-autocomplete autocomplete autocomplete-right">
                                        <input name="alias" type="hidden" class="processor-id" value="<?= $card2->alias ?>">
                                        <input type="text" class="autocomplete-input typing" data-type="cpu" value="<?= $card2->name ?>">
                                        <span class="autocomplete-placeholder text-right"><?= $card2->name ?></span>
                                        <div class="autocomplete-dropdown">
                                            <div class="autocomplete-dropdown-scroll">
                                            </div>
                                        </div>
                                        <div class="autocomplete-image ml-3" style="background-image: url('<?= $card2->image_mini ?>')"></div>
                                    </div>
                                <?php else : ?>
                                    <div class="tab-form-autocomplete autocomplete autocomplete-right">
                                        <input name="alias" type="hidden" class="processor-id">
                                        <input type="text" class="autocomplete-input typing" data-type="cpu">
                                        <span class="autocomplete-placeholder text-right"><?= Yii::t('app', 'Select processor 2') ?></span>
                                        <div class="autocomplete-dropdown">
                                            <div class="autocomplete-dropdown-scroll">
                                            </div>
                                        </div>
                                        <div class="autocomplete-image ml-3"></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <button type="submit" class="autocomplete-button"><?= Yii::t('app', 'Compare') ?></button>
                    </form>
                </div>

                <div class="tab-pane fade <?= $active_tab == 'gpu' ? 'show active' : '' ?>" id="video-cards" role="tabpanel" aria-labelledby="video-cards-tab">
                    <form action="#" class="position-relative" id="gpu-compare">
                        <div class="row">
                            <div class="col-md-6">
                                <?php if ($card1 && $active_tab == 'gpu') : ?>
                                    <div class="tab-form-autocomplete autocomplete orange">
                                        <input name="alias" type="hidden" class="processor-id" value="<?= $card1->alias ?>">
                                        <div class="autocomplete-image mr-3" style="background-image: url('/images/gpu/gpu_to_compare1.webp')"></div>
                                        <input type="text" class="autocomplete-input typing" value="<?= $card1->name ?>" data-type="gpu">
                                        <span class="autocomplete-placeholder"><?= $card1->name ?></span>

                                        <div class="autocomplete-dropdown">
                                            <div class="autocomplete-dropdown-scroll">
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="tab-form-autocomplete autocomplete orange">
                                        <input name="alias" type="hidden" class="processor-id">
                                        <div class="autocomplete-image mr-3"></div>
                                        <input type="text" class="autocomplete-input typing" data-type="gpu">
                                        <span class="autocomplete-placeholder"><?= Yii::t('app', 'Select video card 1') ?></span>

                                        <div class="autocomplete-dropdown">
                                            <div class="autocomplete-dropdown-scroll">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <?php if ($card2 && $active_tab == 'gpu') : ?>
                                    <div class="tab-form-autocomplete autocomplete orange autocomplete-right">
                                        <input name="alias" type="hidden" class="processor-id" value="<?= $card2->alias ?>">
                                        <input type="text" class="autocomplete-input typing" data-type="gpu" value="<?= $card2->name ?>">
                                        <span class="autocomplete-placeholder text-right"><?= $card2->name ?></span>
                                        <div class="autocomplete-dropdown">
                                            <div class="autocomplete-dropdown-scroll">
                                            </div>
                                        </div>
                                        <div class="autocomplete-image ml-3" style="background-image: url('/images/gpu/gpu_to_compare2.webp')"></div>
                                    </div>
                                <?php else : ?>
                                    <div class="tab-form-autocomplete autocomplete orange autocomplete-right">
                                        <input name="alias" type="hidden" class="processor-id">
                                        <input type="text" class="autocomplete-input typing" data-type="gpu">
                                        <span class="autocomplete-placeholder text-right"><?= Yii::t('app', 'Select video card 2') ?></span>
                                        <div class="autocomplete-dropdown">
                                            <div class="autocomplete-dropdown-scroll">
                                            </div>
                                        </div>
                                        <div class="autocomplete-image ml-3"></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <button type="submit" class="autocomplete-button orange"><?= Yii::t('app', 'Compare') ?></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- compare form -->
    </div>
</header>
<!-- header -->

<?php

$js = <<<JS

$('body').on('click', function(e){
    let b = true;
    for (let item of e.originalEvent.path) {
        if (item.classList) {
            if (item.classList.contains('search')) {
                b = false;
                break;
            }
        }
    }
    if (b) {
        $('.search-result').hide()
    }
})

    $('#cpu-compare').on('submit', function(e){
        e.preventDefault();
        let lang = document.documentElement.lang;
        let arr = $(this).serializeArray();
        if(arr[0].value && arr[0].value){
            let param = arr[0].value + '-vs-' + arr[1].value
            window.location = '/' + lang + '/cpu/compare/' + param            
        }else{
            new Noty({
                type: 'error',
                text: 'Select processor from the list',
                timeout: 3000
            }).show();
        }
    })

    $('#gpu-compare').on('submit', function(e){
        e.preventDefault();
        let lang = document.documentElement.lang;
        let arr = $(this).serializeArray();
        if(arr[0].value && arr[0].value){
            let param = arr[0].value + '-vs-' + arr[1].value
            window.location = '/' + lang + '/gpu/compare/' + param
        }else{
            new Noty({
                type: 'error',
                text: 'Select a video card from the list',
                timeout: 3000
            }).show();
        }
    })
    

    $('.typing').keyup(function(e){
        let val = $(this).val()
        let elem = $(this)
        let type = elem.attr('data-type')

        if(val.length === 0){
            elem.next().next('.autocomplete-dropdown').children('.autocomplete-dropdown-scroll').empty()
            return 0
        }

        $.get('/'+ type +'/autocomplete?str=' + val, function(res){
            let list = createElem('div', '', {'class': 'autocomplete-dropdown-list'})
            if(res.length === 0){
                elem.next().next('.autocomplete-dropdown').children('.autocomplete-dropdown-scroll').empty().html("<div class='autocomplete-empty'>Ничего не найдено</div>")
                return 0
            }
            for (let cpu of res){
                let item = createElem('div', '', {'class': 'autocomplete-dropdown-item'})
                    createElemIn(item, 'img', '', {src: cpu.image_mini })
                    createElemIn(item, 'span', cpu.name)

                    item.addEventListener('click', function(){
                        elem.hide();
                        elem.val(cpu.name);
                        elem.next().next(".autocomplete-dropdown").hide();
                        elem.next().show().text(cpu.name);
                        elem.parent().removeClass("autocomplete-open");
                        elem.parent('.autocomplete').children('.autocomplete-image').css({'background-image': 'url('+ cpu.image_mini +')'})
                        elem.parent('.autocomplete').children('.processor-id').val(cpu.alias)
                    })
                add(list, item)
            }
            elem.next().next('.autocomplete-dropdown').children('.autocomplete-dropdown-scroll').empty().html(list)

        })

    })

    $(document).on('click', function(e){
        var trigger = $(".autocomplete.autocomplete-open");
        if(trigger.length){
            if(trigger !== e.target && !trigger.has(e.target).length){
                $(".autocomplete-input").hide();
                $(".autocomplete-dropdown").hide();
                $('.processor-typing').hide();
                $('.autocomplete-placeholder').show();
                $(".autocomplete").removeClass("autocomplete-open");
            }
        }
    })

	function add(parentElement, childElement) {
		return parentElement.appendChild(childElement);
	}
	function createElem(name, text = null, attr = []) {
		var el = document.createElement(name);
		if (attr !== null) {
			for (var i in attr) {
				el.setAttribute(i, attr[i]);
			}
		}
		el.innerHTML = text;
		return el;
	}
	function createElemIn(elm, name, text = null, attr = []) {
		var el = document.createElement(name);
		el.innerHTML = text;

		if (attr !== null) {
			for (var i in attr) {
				el.setAttribute(i, attr[i]);
			}
		}
		elm.appendChild(el);
		return elm;
	}

JS;
$this->registerJs($js);

?>