<?php


class Helper extends mainController
{
   public function redirectAfterFormSuccess($controller, $action, $status = '', $message = '', $id = '')
   {
       $this->getStatus($status, $message);
       $url = Url::getUrl($controller, $action, array(
           'id' => ($id == '') ? '' : $id,
           'status' => ($status == '') ? '' : $status,
           'message' => ($message == '') ? '' : $message,

       ));

//       if($id ==! '')
//       {
//           $url = Url::getUrl($controller, $action, array(
//               'id' => $id,
//               'status' => $status,
//               'message' => $message,
//           ));
//       }

       return header("Location: {$url}");
   }
}