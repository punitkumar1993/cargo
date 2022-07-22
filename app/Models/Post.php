<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\Resources;
use Throwable;
use Log;
use Carbon\Carbon;

class Post extends Model
{
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_title',
        'post_summary',
        'post_name',
        'post_content',
        'post_image',
        'post_image_alt',
        'post_hits',
        'post_author',
        'post_type',
        'post_status',
        'post_mime_type',
        'post_guid',
        'post_image_meta',
        'meta_description',
        'meta_keyword'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'post_author');
    }

    /**
     * @return BelongsToMany
     */
    public function termtaxonomy()
    {
        return $this->belongsToMany('App\Models\TermTaxonomy', 'term_relationships', 'post_id', 'term_taxonomy_id')->withTimestamps();
    }

    /**
     * @return HasManyThrough
     */
    public function term()
    {
        return $this->hasManyThrough(
            'App\Models\Term',
            'App\Models\TermTaxonomy',
            'term_id',
            'id',
            'id',
            'id'
        );
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePostType($query)
    {
        return $query->wherePostType('post');
    }

    /**
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeOfType($query, $type)
    {
        return $query->wherePostType($type);
    }

    public static function getNewsLetterData()
    {
        $postData = DB::table('posts')->where('post_status', 'publish')->limit(4)->offset(0)->orderBy('id', 'DESC')->get();
        $postData2 = DB::table('posts')->where('post_status', 'publish')
            ->whereNotIn('id', $postData->pluck('id')->toArray())
            ->limit(4)->offset(0)->orderBy('id', 'DESC')->get();

        $postData = json_decode(json_encode($postData), true);
        $postData2 = json_decode(json_encode($postData2), true);

        return [
            'postData'  => $postData,
            'postData2' => $postData2,
        ];
    }

    public static function getMagazineData()
    {
        return DB::table('users')
            ->where('username', 'magazine-user')
            ->orderBy('id', 'DESC')->get();
    }

    /**
     * Send news letter
     *
     * @return array
     * @throws Throwable
     */
    public static function sendNewsLetter()
    {
        try {

            // Send transactional emails (note: prefer using SwiftMailer to send transactionnal emails)

            $data = self::getNewsLetterData();

            $posts1 = $data['postData'];
            $posts2 = $data['postData2'];

            $message = "Cargo Trends: Newsletter";
            $users = DB::table('newsletter_subscribes')->where('unsubscribe', 0)->get();
            Log::info("Start Newsletter Send to ".$users->count()." user on".Carbon::now());
            foreach ($users as $key => $value) {
                $emails = $value->email;
                $emailId = base64_encode($emails);
                Log::info($key." Email Send to ".$emails);

                $html = view('frontend.magz.emails.news_subscribe_email', compact('posts1', 'posts2', 'emailId'))->render();

                $body = [
                    'FromEmail'  => Config::get('adminlte.mailJetFromEmail'),
                    'FromName'   => Config::get('adminlte.mailJetFromName'),
                    'Subject'    => "Cargo Trends: Newsletter",
                    'Text-part'  => strip_tags($html),
                    'Html-part'  => $html,
                    'Recipients' => [['Email' => $emails]]
                ];

                self::sendEmailMailJet($body);

                //sleep for 5 seconds
                sleep(1);
            }
            
            Log::info("End Newsletter Send to user on".Carbon::now());

            return [
                'error'   => false,
                'message' => "Newsletter has been sent successfully to all subscribers."
            ];
        } catch (Exception $e) {
            return [
                'error'   => true,
                'message' => "Something goes wrong, please try again later!"
            ];
        }

    }


    /**
     * Send magazine
     *
     * @return array
     * @throws Throwable
     */
    public static function sendMagazineLetter($magazineName,$magazineImage)
    {
        try {

            // Send transactional emails (note: prefer using SwiftMailer to send transactionnal emails)
            $users = self::getMagazineData();


            foreach ($users as $key => $value) {
                $emails = $value->email;

                $html = view('frontend.magz.emails.magazine_subscribe_email')
                    ->with('magazineName', $magazineName)->with('magazineImage',$magazineImage)->render();

                $body = [
                    'FromEmail'  => Config::get('adminlte.mailJetFromEmail'),
                    'FromName'   => Config::get('adminlte.mailJetFromName'),
                    'Subject'    => "Cargo Trends Magazine " . $magazineName . " Published",
                    'Text-part'  => strip_tags($html),
                    'Html-part'  => $html,
                    'Recipients' => [['Email' => $emails]]
                ];

                self::sendEmailMailJet($body);

                //sleep for 2 seconds
                sleep(2);
            }

            return [
                'error'   => false,
                'message' => "Magazine has been sent successfully to all subscribers."
            ];
        } catch (Exception $e) {
            return [
                'error'   => true,
                'message' => "Something goes wrong, please try again later!"
            ];
        }

    }

    /**
     * Send email through Mail Jet
     *
     * @param $body
     * @return array
     */
    public static function sendEmailMailJet($body)
    {
        try {
            $mailjet = Mailjet::getClient();

            $response = $mailjet->post(Resources::$Email, ['body' => $body]);

            return [
                'error'   => false,
                'message' => $response
            ];
        } catch (Exception $e) {
            return [
                'error'   => true,
                'message' => "Something goes wrong, please try again later!" . $e->getMessage()
            ];
        }
    }

}
