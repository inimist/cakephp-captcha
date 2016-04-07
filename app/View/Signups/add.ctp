<style>
.creload{margin-left:5px;}
</style>
<?php
echo $this->Session->flash();
echo $this->Form->create("Signups");
?>
<fieldset style="border: 1px solid #B3B3B3;"><legend style="padding:0 
10px;">Sign Up</legend>
<?php
$this->Captcha->render(array('type'=>'image'));
echo $this->Form->submit(__(' Submit ',true));
echo '</fieldset>';
echo $this->Form->end();
//Signup form ends
?>
<script 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
jQuery('.creload').on('click', function() {
    var mySrc = $(this).prev().attr('src');
    var glue = '?';
    if(mySrc.indexOf('?')!=-1)  {
        glue = '&';
    }
    $(this).prev().attr('src', mySrc + glue + new Date().getTime());
    return false;
});
</script>