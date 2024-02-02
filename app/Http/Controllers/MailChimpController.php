<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MailchimpMarketing\ApiClient;

class MailChimpController extends Controller
{
    public $client;
    public function __construct() {
        $this->client = new ApiClient();
        $this->client->setConfig([
            'apiKey' => env('MAILCHIMP_API_KEY'),
            'server' => env('MAILCHIMP_SERVER_PREFIX')
        ]);
    }

    public function createAudiance(){
        $client = $this->client;
        try{
        $response = $client->lists->createList([
            "name" => "some name",
            "permission_reminder" => "permission_reminder",
            "email_type_option" => true,
            "contact" => [
                "company" => "Mailchimp",
                "address1" => "675 Ponce de Leon Ave NE",
                "city" => "Atlanta",
                "state" => "GA",
                "zip" => "30308",
                "country" => "US",
              ],
            "campaign_defaults" => [
                "from_name" => "Gettin' Together",
                "from_email" => "gettingtogether@aas.com",
                "subject" => "PHP Developer's Meetup",
                "language" => "EN_US",
              ],
        ]);

        return $response;
        } catch (MailchimpMarketing\ApiException $e) {
        return $e->getMessage();
        }
    }

    public function getAudianceList(){
        $client = $this->client;
        try{
            $response = $client->lists->getAllLists();
            return $response;
        } catch (MailchimpMarketing\ApiException $e) {
            return $e->getMessage();
        }
    }

    public function getAudiance(){
        $list_id= request()->all();
        return $list_id;
        $client = $this->client;
        try{
            $response = $client->lists->getList($list_id);
            return $response;
        } catch (MailchimpMarketing\ApiException $e) {
            return $e->getMessage();
        }
    }
    
    public function updateAudiance($list_id){
        $client = $this->client;
        try{
            $response = $client->lists->updateList($list_id, [
                "name" => "name",
                "permission_reminder" => "permission_reminder",
                "email_type_option" => false,
                "contact" => [
                    "company" => "Mailchimp",
                    "address1" => "675 Ponce de Leon Ave NE",
                    "city" => "Atlanta",
                    "state" => "GA",
                    "zip" => "30308",
                    "country" => "US",
                    "phone" => "11223344",
                ],
                "campaign_defaults" => [
                    "from_name" => "from nam here",
                    "from_email" => "xtramailxyz@gmail.com",
                    "subject" => "subject here",
                    "language" => "EN_US",
                ],
            ]);
            return $response;
        } catch (MailchimpMarketing\ApiException $e) {
            return $e->getMessage();
        }
    }

    public function deleteAudiance($list_id){
        $client = $this->client;
        try {
            $response = $client->lists->deleteList($list_id);
            return $response;
        } catch (MailchimpMarketing\ApiException $e) {
            return $e->getMessage();
        }

    }

    public function addMergeField($list_id){
        $client = $this->client;
        try{
            $response = $client->lists->addListMergeField($list_id, [
                "name" => "field_name",
                "type" => "text",
            ]);
            return $response;
        } catch (MailchimpMarketing\ApiException $e) {
        return $e->getMessage();
        }
    }

    public function addContact(Request $request){
        $list_id= $request->list_id;
        $client = $this->client;
        try{
            $response = $client->lists->addListMember($list_id, [
                "email_address" => $request->EMAIL,
                "status" => "subscribed",
                "merge_fields" => [
                  "FNAME" => $request->FNAME,
                  "PHONE" => $request->PHONE
                ]
            ]);
            return $response;
        } catch (MailchimpMarketing\ApiException $e) {
        return $e->getMessage();
        }
    }

    public function contactStatus($list_id, $email){
        $client = $this->client;
        $subscriber_hash = md5(strtolower($email));
        try{
            $response = $client->lists->getListMember($list_id, $subscriber_hash);
            return $response;
        } catch (MailchimpMarketing\ApiException $e) {
        return $e->getMessage();
        }
    }

    public function contactUnsubscribe($list_id, $email){
        $client = $this->client;
        $subscriber_hash = md5(strtolower($email));
        try{
            $response = $client->lists->updateListMember($list_id, $subscriber_hash, ["status" => "unsubscribed"]);
            return $response;
        } catch (MailchimpMarketing\ApiException $e) {
        return $e->getMessage();
        }
    }
}
