<?php
namespace App\Traits;
trait SendMessage {
    public function sendMsgBulk($recipients, $message, $template_id="") //bulk
    {
      $uri='http://bulksms.tekhook.in/app/smsapi/index.php?key=5573081BA8E979&routeid=310&type=text&contacts='.urlencode($recipients).'&senderid=LAUNGY&msg='.urlencode($message).'&tlv={"PE_ID":"1201159274572705556","Template_ID":"'.$template_id.'"}';
      $result = file_get_contents($uri);
      return $result;
    }
}