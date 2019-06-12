<?php
    use app\assets\AppAsset;

    AppAsset::register($this);
?>

<div id="hashTagContent" class="content">

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Update Hashtag</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <form class="form-inline" action="">
            <div class="form-group">
                <label for="email">Hashtag:</label>
                <input  id="hashUpdate" type="email" class="form-control">
            </div>
           
            <button type="submit" class="btn btn-default" style="background-color:#00ACAC">Update</button>
        </form>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
        <?php foreach($array_hash_tags as $hash_tags): ?>
            <span id="tagBlock" class="<?=$hash_tags?> tagBlock2"><b><?= $hash_tags ?></b>
                <input type="hidden" id="hid" value="<?=$hash_tags?>" /> 
                <span class="closeCaret" id="<?=$hash_tags?>">
                    <a id="delete_tag" class="<?=$hash_tags?>" href="#">X</a>
                </span> 
            </span>
        <?php endforeach; ?>
    
    <input type="hidden" id="baseUrl" value="<?=$baseUrl?>/index.php/admin/delete-tags"/>
    <input type="hidden" id="keyword_id" value="<?=$keyword_id?>"/>
</div>

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Save changes</button>
    </div>
</div>