<? ?>
<? if (isset($this->data)) { ?>
    <? // debug($this->data);       ?>
    <? // debug($this->user->information);       ?>
    <? //    var_dump($_SESSION, false);      ?>

    <div class="content">
        <? // $this->load->view("menukapp"); ?>
        <div class="columns-content topen" style="left: 0px !important">
            <? // for ($i = 0; $i <= 2; $i++) { ?>
                <? $this->load->view("content"); ?>
            <? // } ?>
        </div>
    </div>
    <?
} else {
    
}
?>
<? $this->load->view('footer') ?>
<!--141013510-->
