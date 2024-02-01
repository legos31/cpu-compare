<?php
$this->title = 'Site map';
$this->registerMetaTag(['name' => 'description', 'content' => 'Site map']);
//$this->description = 'Site map';
?>
<div class="container sitemap">
    <h1>Site map</h1>
    <br>
    <div> <a href="/map/cpu-list">Cpu list</a> </div>
    <div> <a href="/map/compare?category=1">Cpu compare list</a> </div>

    <br>
    <div> <a href="/map/gpu-list">Gpu list</a> </div>
    <div> <a href="/map/compare?category=2">Gpu compare list</a> </div>
</div>
<style>
    .sitemap{
        padding-top: 100px;
        padding-bottom: 300px;
    }
    .sitemap a{
        font-size: 16px;
        font-weight: 500;
    }
</style>