<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 5/1/2018
 * Time: 2:34 AM
 */

class Message
{
    public static function show($message)
    {
        echo "
          <div class='modal fade' id='messageModal' role='dialog'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h3 class='modal-title'>رسالة إدارية</h3>
        </div>
        <div class='modal-body'>
          <p>$message</p>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-success' data-dismiss='modal'>موافق</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    $('#messageModal').modal('show');
</script>
        ";
    }

}