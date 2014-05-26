<!-- https://github.com/hugodias/cakegallery/blob/master/View/Albums/upload.ctp -->
<!-- ********** Begin Ajax request in Cakephp *************** --> 
    <!-- 1- in the View -->
        <!-- 1- first  serialize Form that you want to send request -->
        <!-- 2- get Form and in the submit event we say send data to which action and with place must be update and .... -->

    <!-- 2- in the Controller -->
        <!-- 1 - in the controller if we want to just do some action and just show success mesaeg we must  set render to false  --like this --  $this->render(false, false); -->
<!-- ********** End Ajax request in Cakephp *************** --> 






<!-- ****************** Begin  in the View File        ****************** -->
<div class="row">
    <div class="col-md-12">
        <div id="folderStatus" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    </div>
</div>
<?php
    $data = $this->Js->get('#AlbumUpdateForm')->serializeForm(
        array('isForm' => true, 'inline' => true)
    );
    $this->Js->get('#AlbumUpdateForm')->event(
        'submit',
        $this->Js->request(
            array('action' => 'update'),
            array(
                'update' => '#folderStatus',
                'data' => $data,
                'async' => true,
                'dataExpression' => true,
                'method' => 'POST',
                'complete' => '$(".alert-success").fadeIn(600); window.setTimeout(function(){$(".alert-success").fadeOut(400)}, 2000); '
            )
        )
    );
?>
<div class="row">
    <?php 
       echo $this->Form->create('Gallery.Album', array('action' => 'update', 'default' => false));
         echo $this->Form->input('title',array('label'=>__('title')));
         echo $this->Form->end('finish');
     ?>
</div>
<?php echo $this->Js->writeBuffer(); ?>

<!-- ****************** End  in the View File          ****************** -->




<!-- ****************** Begin  in the Controller File  ****************** -->
<?php 
public function update()
{
    if ($this->request->is('post')) {
        
        if ($this->Album->save($this->request->data)) {
            echo "You configurations are saved.";
        }
    }
    $this->render(false, false);
}
 ?>
<!-- ****************** End   in the Controller File   ****************** -->











