<?php
class clsInputValidate
{
  static public function Test_Input($Data):string
  {
    return htmlspecialchars(stripcslashes(trim($Data)));
  }

}



?>