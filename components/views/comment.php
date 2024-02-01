<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<!-- comment  -->
<div id="c-container">
    <div class="block mb-30" id="comments">
        <div class="title mb-30"><?=Yii::t('app','Comments')?> <span class="comment-count"><?= $comment_count ?></span>
        </div>
        <div class="comments">
            <?php foreach ($comments as $item) : ?>
                <div class="comment">
                    <div class="comment-header">
                        <div class="comment-flex">
                            <div class="comment-name"><?= $item->user->name ?></div>
                            <div class="comment-date"><?= commentDate($item->date) ?></div>

                        </div>
                    </div>
                    <div class="comment-body">
                        <?= $item->message ?>
                    </div>
                    <div class="comment-footer">
                        <a href="#commentform" class="to_scroll">
                            <button type="button" class="btn btn-yellow btn-comment ansver" data-id="<?= $item->id ?>"> <?=Yii::t('app','Ansver')?> </button>
                        </a>
                        <div class="comment-actions">
                            <div class="comment-like" data-id="<?= $item->id ?>" data-count="<?= $item->likeCount ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                                    <g fill-rule="evenodd">
                                        <path d="M0 6.25v10c0 .69.56 1.25 1.25 1.25H5V5H1.25C.56 5 0 5.56 0 6.25zM17.692 6.25h-3.693c-.323 0-.485-.216-.539-.308-.054-.093-.164-.339-.008-.62l1.302-2.345c.286-.513.315-1.117.081-1.656-.234-.54-.695-.93-1.266-1.073l-.918-.23c-.223-.055-.46.016-.615.189L7.05 5.744c-.517.575-.801 1.318-.801 2.09v6.54c0 1.724 1.402 3.126 3.125 3.126h6.218c1.403 0 2.643-.946 3.014-2.3l1.334-6.123c.039-.17.059-.344.059-.519 0-1.273-1.036-2.308-2.308-2.308z" />
                                    </g>
                                </svg>
                                <span class="like-count">
                                            <?= $item->likeCount ?>
                                        </span>
                            </div>
                            <div class="comment-dislike" data-id="<?= $item->id ?>" data-count="<?= $item->dislikeCount ?>">
                                        <span class="dislike-count">
                                            <?= $item->dislikeCount ?>
                                        </span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                                    <g fill-rule="evenodd">
                                        <path d="M0 6.25v10c0 .69.56 1.25 1.25 1.25H5V5H1.25C.56 5 0 5.56 0 6.25zM17.692 6.25h-3.693c-.323 0-.485-.216-.539-.308-.054-.093-.164-.339-.008-.62l1.302-2.345c.286-.513.315-1.117.081-1.656-.234-.54-.695-.93-1.266-1.073l-.918-.23c-.223-.055-.46.016-.615.189L7.05 5.744c-.517.575-.801 1.318-.801 2.09v6.54c0 1.724 1.402 3.126 3.125 3.126h6.218c1.403 0 2.643-.946 3.014-2.3l1.334-6.123c.039-.17.059-.344.059-.519 0-1.273-1.036-2.308-2.308-2.308z" transform="matrix(1 0 0 -1 0 18)" />
                                    </g>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
                <?php echo generateChildren($item->children);  ?>
            <?php endforeach ?>


            <div class="comments-form" id="commentform">
                <div class="title mb-30"><?=Yii::t('app','Leave a comment')?></div>
                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['comments/create'])
                ]) ?>
                <?= $form->field($comment, 'parent_id')->hiddenInput()->label(false) ?>
                <?= $form->field($comment, 'blok')->hiddenInput()->label(false) ?>
                <?= $form->field($comment, 'blok_id')->hiddenInput()->label(false) ?>
                <div class="comments-form-body">
                    <div class="comments-form-row">
                        <div class="comments-form-input">
                            <?= $form->field($comment, 'username')->textInput(['placeholder' => Yii::t('app', 'Name')])->label(false) ?>
                        </div>
                        <div class="comments-form-input">
                            <?= $form->field($comment, 'email')->textInput(['placeholder' => 'E-mail'])->label(false) ?>
                        </div>
                    </div>
                    <div class="comments-form-textarea">
                        <?= $form->field($comment, 'message')->textarea(['placeholder' => Yii::t('app', 'Message'), 'rows' => 5])->label(false) ?>
                    </div>
                    <div class="comments-form-flex">
                        <div class="my-checkbox">
                            <input type="checkbox" name="CommentForm[subscribe]" id="customCheck1">
                            <label for="customCheck1"><?=Yii::t('app', 'Subscribe to comments')?></label>
                        </div>

                        <button type="submit" class="btn btn-yellow btn-medium"><?=Yii::t('app', 'Send')?></button>
                    </div>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>


<?php

function generateChildren($children, $u = 1)
{
    $list = "";
    foreach ($children as $key => $child) {
        $list .= '<div class="comment comment-m' . $u . '">
                        <div class="comment-header">
                            <div class="comment-flex">
                                <div class="comment-name">' . $child->user->name . '</div>
                                <div class="comment-date">' . commentDate($child->date) . '</div>
                            </div>
                        </div>
                        <div class="comment-body">' . $child->message . '</div>
                        <div class="comment-footer">
                            <a href="#commentform" class="to_scroll">
                                <butto type="button" class="btn btn-yellow btn-comment ansver" data-id="' . $child->id . '"> Ansver </butto>
                            </a>
                            <div class="comment-actions">
                                <div class="comment-like" data-id="' . $child->id . '" data-count="' . $child->likeCount . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                                        <g fill-rule="evenodd">
                                            <path d="M0 6.25v10c0 .69.56 1.25 1.25 1.25H5V5H1.25C.56 5 0 5.56 0 6.25zM17.692 6.25h-3.693c-.323 0-.485-.216-.539-.308-.054-.093-.164-.339-.008-.62l1.302-2.345c.286-.513.315-1.117.081-1.656-.234-.54-.695-.93-1.266-1.073l-.918-.23c-.223-.055-.46.016-.615.189L7.05 5.744c-.517.575-.801 1.318-.801 2.09v6.54c0 1.724 1.402 3.126 3.125 3.126h6.218c1.403 0 2.643-.946 3.014-2.3l1.334-6.123c.039-.17.059-.344.059-.519 0-1.273-1.036-2.308-2.308-2.308z" />
                                        </g>
                                    </svg>
                                    <span class="like-count">' . $child->likeCount . ' </span>
                                </div>
                                <div class="comment-dislike" data-id="' . $child->id . '" data-count="' . $child->dislikeCount . '">
                                    <span class="dislike-count">
                                        ' . $child->dislikeCount . '
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                                        <g fill-rule="evenodd">
                                            <path d="M0 6.25v10c0 .69.56 1.25 1.25 1.25H5V5H1.25C.56 5 0 5.56 0 6.25zM17.692 6.25h-3.693c-.323 0-.485-.216-.539-.308-.054-.093-.164-.339-.008-.62l1.302-2.345c.286-.513.315-1.117.081-1.656-.234-.54-.695-.93-1.266-1.073l-.918-.23c-.223-.055-.46.016-.615.189L7.05 5.744c-.517.575-.801 1.318-.801 2.09v6.54c0 1.724 1.402 3.126 3.125 3.126h6.218c1.403 0 2.643-.946 3.014-2.3l1.334-6.123c.039-.17.059-.344.059-.519 0-1.273-1.036-2.308-2.308-2.308z" transform="matrix(1 0 0 -1 0 18)" />
                                        </g>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>';

        if (count($child->children)) {
            $list .= generateChildren($child->children, 2);
        }
    }
    return $list;
}

$js = <<<JS


$(document).on('click', '.comment-like', function(e){
    let elem = $(this);
    let id = elem.attr('data-id')
    $.get('/comments/like?id=' + id, function(res){
        if(res){
            $('#c-container').load(window.location + ' #comments');
        }
    })
})

$(document).on('click', '.comment-dislike', function(e){
    let elem = $(this);
    let id = elem.attr('data-id')
    $.get('/comments/dislike?id=' + id, function(res){
        if(res){
            $('#c-container').load(window.location + ' #comments');
        }
    })
})


$('.ansver').click(function(){
    let id = $(this).attr('data-id')
    console.log(id)
    $('#commentform-parent_id').val(id)
})

JS;

$this->registerJs($js);


?>