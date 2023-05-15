<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use SendGrid\Mail\Mail;
use Mail;
use App\Models\PasswordReset;
use App\Models\PasswordReset2;
use App\Models\user_infos;
use App\Models\DjUser;
use App\Models\Contact;
use App\Models\Users;

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
    public static function passwordReset2($useremail){
        $password = PasswordReset2::where('email','=',$useremail)->pluck('password');
        $to_name = $useremail;
        $to_email = $useremail;
        $data = array("useremail"=>$useremail);
        Mail::send("forget2", $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject("Reset Password");
        $message->from("4rizontech@gmail.com","4rizon Contact");});
    }
    public static function passwordResetAdmin($useremail){
        $to_name = $useremail;
        $to_email = $useremail;
        $data = array("useremail"=>$useremail);
        Mail::send("forgot3", $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject("Reset Password");
        $message->from("4rizontech@gmail.com","4rizon Contact");});
    }

    public static function welcomeEmail($useremail){
        $to_name = $useremail;
        $to_email = $useremail;
        $data = array("useremail"=>$useremail);
        Mail::send("welcomeMail", $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject("Welcome to 4rizon");
        $message->from("4rizontech@gmail.com","4rizon Contact");});

        // self::sendEmail($email);
    }

    public static function notifications($useremail){
        $password = user_infos::where('email','=',$useremail)->pluck('email');
        $to_name = $useremail;
        $to_email = $useremail;
        $data = array("useremail"=>$useremail);
        Mail::send("notifications", $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject("User Approved");
        $message->from("4rizontech@gmail.com","4rizon Contact");});
    }
    public static function dj_assignment($useremail){
        $password = DjUser::where('email','=',$useremail)->pluck('email');
        $to_name = $useremail;
        $to_email = $useremail;
        $data = array("useremail"=>$useremail);
        Mail::send("dj_assignment", $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject("You have been assigned an event");
        $message->from("4rizontech@gmail.com","4rizon Contact");});
    }
    public static function contact($name,$email,$messagee){
    $to_name = "Misbah Ayaz";
    $to_email = "misbah.ayaz@kasparholdings.com";
    $data = array("name"=>$name,"email"=>$email,"messagee"=>$messagee);
    Mail::send("contact", $data, function($message) use ($to_name, $to_email) {
    $message->to('contact@4rizon.com', $to_name)
    ->subject("Contact Us");
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
