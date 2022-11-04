<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SendGrid\Mail\Mail;
use App\Models\PasswordReset;

class UserEmails extends Model
{
    // const apiKey = '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';
    const apiKey = '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';
    const apiKey1 = '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';
    public static function signUpEmail($useremail, $link){
        $email = new Mail();
        $email->setFrom("jynxbykcs@gmail.com", "4rizon Contact");
        $email->setSubject("Welcome to 4rizon");
        $email->addTo($useremail);
        $email->addContent(
            "text/html", "                
                <div style='background-color:#d4d3dc;padding:20px'>
                    <div style='max-width:600px;margin:0 auto'>
                        <div style='background:#fff;font:14px sans-serif;color:#686f7a;border-top:4px solid #ce171f;margin-bottom:20px;border-bottom: 4px solid #ce171f;'>
                            <div class='border-bottom:1px solid #f2f3f5;padding:20px 30px'>
                                <img src=\"http://kaspar.eastus.cloudapp.azure.com/jynx_testing/new/images/jynxlogo.jpeg\" alt='4rizon' style='max-width:115px;display:block;margin: 10px 29px;'>
                            </div>
                            <div style='padding:20px 30px'>
                                <div style='font-size:16px;line-height:1.5em;border-bottom:1px solid #f2f3f5;padding-bottom:10px;margin-bottom:20px'>
                                    <p><a style='text-decoration:none;color:#000'>Welcome <strong>".$useremail."</strong>,</a></p>
                                    <p><a style='text-decoration:none;color:#000'>Thank You for registration on our website.</a></p>
                                    <p><a style='text-decoration:none;color:#000'>Your Account Verification Code:</a></p>
                                    <a target='_blank' style='font-size:16px;color:#ffffff;text-decoration:none;border-radius:2px;background-color:#ff5d03;border-top:12px solid #ff5d03;border-bottom:12px solid #ff5d03;border-right:18px solid #ff5d03;border-left:18px solid #ff5d03;display:inline-block'>
                                        ".$link."
                                    </a>
                                    <p><a style='text-decoration:none;color:#000'><strong>Note:</strong> Contact us <strong><a href='https://4rizon.com' target='_blank'>Here</a></strong> immediately if you did not authorize this registration.</a></p>
                                </div>
                            </div>
                        </div>
                        <div style='font:11px sans-serif;color:#3e3e3e'>
                            Delivered by www.4rizon.com - All Rights Reserved.
                        </div>
                    </div>
                </div>"
        );
        self::sendEmail($email);
    }
    public static function passwordReset($useremail){
        $password = PasswordReset::where('email','=',$useremail)->pluck('password');
        
        $email = new Mail();
        $email->setFrom("jynxbykcs@gmail.com", "4rizon Contact");
        $email->setSubject("Reset Password");
        $email->addTo($useremail);
        $email->addContent(
            "text/html", "                
                <div style='background-color:#d4d3dc;padding:20px'>
                    <div style='max-width:600px;margin:0 auto'>
                        <div style='background:#fff;font:14px sans-serif;color:#686f7a;border-top:4px solid #ce171f;margin-bottom:20px;border-bottom: 4px solid #ce171f;'>
                            <div class='border-bottom:1px solid #f2f3f5;padding:20px 30px'>
                                <img src=\"http://kaspar.eastus.cloudapp.azure.com/jynx_testing/new/images/jynxlogo.jpeg\" alt='4rizon' style='max-width:115px;display:block;margin: 10px 29px;'>
                            </div>
                            <div style='padding:20px 30px'>
                                <div style='font-size:16px;line-height:1.5em;border-bottom:1px solid #f2f3f5;padding-bottom:10px;margin-bottom:20px'>
                                    <p><a style='text-decoration:none;color:#000'>Welcome <strong>".$useremail."</strong>,</a></p>
                                    <p><a href='http://kaspar.eastus.cloudapp.azure.com/jynx_testing/reset_password'>Reset Your Account password here </a></p>
                                    <p><a style='text-decoration:none;color:#000'><strong>Note:</strong> Contact us <strong><a href='https://4rizon.com' target='_blank'>Here</a></strong> immediately if you did not make this request.</a></p>
                                </div>
                            </div>
                        </div>
                        <div style='font:11px sans-serif;color:#3e3e3e'>
                            Delivered by www.4rizon.com - All Rights Reserved.
                        </div>
                    </div>
                </div>"
        );
        self::sendEmail($email);
    }
    public static function sendEmail($email){
        $sendgrid = new \SendGrid(self::apiKey1);
        try {
            $response = $sendgrid->send($email);
        } catch (\Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}
