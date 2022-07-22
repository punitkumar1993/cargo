<?php



namespace App\Http\Controllers;



use App\Helpers\Settings;
use Illuminate\Http\Request;

use DB;

use Mail;



class NewsSubscribeletter extends Controller

{

    /**

     * @param Request $request

     * @throws \Illuminate\Validation\ValidationException

     */

    public function subscribe(Request $request)

    {
        $this->validate($request, [

            'email' => 'required|email',

        ]);

        $check_email = DB::table('newsletter_subscribes')->where('email',request('email'))->where('unsubscribe',0)->exists();
        

        if($check_email)
        {
            return response()->json(['errors'  => ["email" => "The email has already been taken."]], 422);
        }
        else
        {
            $result =    DB::table('newsletter_subscribes')->updateOrInsert(
                            ['email' => request('email')],['created_at' => date('Y-m-d H:i:s'),'unsubscribe' => 0]);

            return $result;
        }

    }

    /**
     * Unsubscribe email
     *
     * @param $email
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unSubscribe($email){

        $email = base64_decode($email);
        DB::table('newsletter_subscribes')->where('email', $email)->update(['unsubscribe'=>1]);

        return view(Settings::active_theme('page/unsubscribe'));
    }



    public function sendEmailToNewsSubscriber(){


        $message  = "Cargo Trends: Newsletter";

        $users =  DB::table('newsletter_subscribes')->where('unsubscribe',0)->get();

        /*$emails = array();

        foreach ($users as $key => $value) {

          array_push($emails, $value->email);

        }*/

        $postData =  DB::table('posts')->where('post_status', 'publish')->limit(4)->offset(0)->orderBy('id', 'DESC')->get();
        $postData2 =  DB::table('posts')->where('post_status', 'publish')
            ->whereNotIn('id',$postData->pluck('id')->toArray())
            ->limit(4)->offset(0)->orderBy('id', 'DESC')->get();

        $postData = json_decode(json_encode($postData), true);
        $postData2 = json_decode(json_encode($postData2), true);

        $data['posts1'] = $postData;
        $data['posts2'] = $postData2;
        /*$posts1 = $postData;
        $posts2 = $postData2;
        $emailId = 'teste@df.dfd';

        echo view('frontend.magz.emails.news_subscribe_email', compact('posts1','posts2','emailId'))->render();
        exit();*/

        foreach ($users as $key => $value) {
            $emails = $value->email;
            $data['emailId'] = base64_encode($emails);
            Mail::send( 'frontend.magz.emails.news_subscribe_email', $data, function($message)
            use ( $emails ) {

                $message->to($emails )

                    ->subject('Cargo Trends: Newsletter')

                    ->from( 'notifications@cargotrends.in', 'Cargo Trends' );

            });
        }

        if( count(Mail::failures()) > 0 ){

            return false;

        }

        return true;

    }

    public function magzine(){
       //echo app_path();
        // include(app_path() . '\functions\prices.php');
       // echo include('/home1/bookmyho/public_html/new_cargo/3dcargo/'.'index.html');
        return view(Settings::active_theme('page/magazine'));
//        return view('magzine');
    }

}

