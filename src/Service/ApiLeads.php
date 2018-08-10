<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 8/10/2018
 * Time: 4:28 AM
 */

namespace App\Service;

/**
 * Class ApiLeads
 * @package App\Service
 */
class ApiLeads
{
    /**
     * @return array
     * @param $contact
     * @param $request
     */
    public function ApiPostAction($contact, $request)
    {

        $data = [
            'json' => json_encode([
                'label' => $contact->getCompleteName(),
                'first_name' => $contact->getCompleteName(),
                'last_name' => $contact->getCompleteName(),
                'email' => $contact->getEmail(),
                'phone' => '',
                'conversion_amount' => 0.0,
                'service_target' => 'ANCA',
                'campaign_key' => 3652954399,
                'data' => [
                    ''
                ]
            ])
        ];


        $ch = \curl_init('http://crm.epcvip.com/api/leads');
        \curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        \curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        \curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ',
                'Authorization: Bearer 0a9fab36846de8eb1aaba3df017346c34996b93f',
            )
        );
        \curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        \curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = \curl_exec($ch);
        \curl_close($ch);

        dump($result);

        return $result;

        //Good
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => "http://crm.epcvip.com/api/leads",
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 30,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => "POST",
//            CURLOPT_POSTFIELDS => $data,
//            CURLOPT_HTTPHEADER => array(
//                'Content-Type: application/json',
//                'Content-Length: ',
//                'Authorization: Bearer 0a9fab36846de8eb1aaba3df017346c34996b93f',
//            ),
//        ));
////
//        $response = curl_exec($curl);
//        $err = curl_error($curl);
//
//        curl_close($curl);
//
//        if ($err) {
////            echo "cURL Error #:" . $err;
////            dump("cURL Error #:" . $err);
//        } else {
////            dump($response);
////            echo $response;
//        }
//
//        return $response;
    }
}