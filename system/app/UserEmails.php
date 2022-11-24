<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use SendGrid\Mail\Mail;
use Mail;
use App\Models\PasswordReset;

class UserEmails extends Model
{
    // const apiKey = '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';
    const apiKey = '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';
    const apiKey1 = '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';
    public static function signUpEmail($useremail, $link){
        $to_name = $useremail;
        $to_email = $useremail;
        $data = array("useremail"=>$useremail, "link" => $link);
        Mail::send("mail", $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject("Welcome to 4rizon");
        $message->from("4rizontech@gmail.com","4rizon Contact");});

        // self::sendEmail($email);
    }
    public static function passwordReset($useremail){
        $password = PasswordReset::where('email','=',$useremail)->pluck('password');
        $to_name = $useremail;
        $to_email = $useremail;
        $data = array("useremail"=>$useremail);
        Mail::send("forget", $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject("Reset Password");
        $message->from("4rizontech@gmail.com","4rizon Contact");});
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
