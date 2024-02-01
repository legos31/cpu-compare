<?php

use yii\helpers\Url;
?>
<style>
    #cookie_note {
        display: none;
        position: fixed;
        bottom: 15px;
        left: 50%;
        max-width: 90%;
        transform: translateX(-50%);
        padding: 20px;
        background-color: white;
        border-radius: 4px;
        box-shadow: 2px 3px 10px rgba(0, 0, 0, 0.4);
        z-index: 2;
        min-width: 350px;
    }

    #cookie_note p {
        margin: 0;
        text-align: left;
        color: black;
    }

    .cookie_accept {
        width: 30%;
    }

    @media (min-width: 576px) {
        #cookie_note.show {
            display: flex;
        }
    }

    @media (max-width: 575px) {
        #cookie_note.show {
            display: block;
            text-align: left;
        }
    }
</style>

<!-- START Cookie-Alert -->
<div id="cookie_note">
    <p><?= $textCookie . ' ' ?><a href="https://cpu-compare.com/privacy" target="_blank"><?= Yii::t('app', 'Privacy police') ?></a>.</p>
    <button class="button cookie_accept btn btn-primary btn-sm"><?= $textButton ?></button>
</div>
<!-- END Cookie-Alert -->

<script>
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        let matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }


    function checkCookies() {
        let cookieNote = document.getElementById('cookie_note');
        let cookieBtnAccept = cookieNote.querySelector('.cookie_accept');

        if (!getCookie('cookies_policy')) {
            cookieNote.classList.add('show');
        }

        cookieBtnAccept.addEventListener('click', function() {
            setCookie('cookies_policy', 'true', 365);
            cookieNote.classList.remove('show');
        });
    }

    checkCookies();
</script>