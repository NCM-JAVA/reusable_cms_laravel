<?php

return [    
  'default'   => [
  'length'    => 5,
  'width'     => 120,
  'height'    => 36,
  'quality'   => 90,
  'math'      => true,  //Enable Math Captcha
  'expire'    => 60,    //Captcha expiration
],
   'ExampleCaptcha' => [
      'UserInputID' => 'CaptchaCode',
      'ImageWidth' => 250,
      'ImageHeight' => 50,
	  'CodeLength' => 6,
      'CodeStyle'    => 'Alpha',
      'CustomCharset' => 'abcdefghijklmnopqrstuvwxyz',
    ]
  
];