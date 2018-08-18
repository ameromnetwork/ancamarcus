<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 8/10/2018
 * Time: 4:28 AM.
 */

namespace App\Service;

use App\Entity\Contact;

/**
 * Class ApiLeads.
 */
class ApiLeads
{
    /**
     * @param Contact $contact
     * @param array   $formData
     *
     * @return mixed
     */
    public function postContactRequest(Contact $contact, array $formData)
    {
        $data = [
            'label' => \sprintf('%s %s', $contact->getFirstName(), $contact->getLastName()),
            'first_name' => $contact->getFirstName(),
            'last_name' => $contact->getLastName(),
            'email' => $contact->getEmail(),
            'conversion_amount' => 0.0,
            'service_target' => 'ANCAMARCUSFIT',
            'campaign_key' => 3652954399,
            'data' => $formData,
        ];

        $encodedData = \json_encode($data);

        $ch = \curl_init('http://crm.epcvip.com/api/leads');
        \curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        \curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        \curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: '.\strlen($encodedData),
                'Authorization: Bearer 0a9fab36846de8eb1aaba3df017346c34996b93f',
            )
        );
        \curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        \curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = \curl_exec($ch);
        \curl_close($ch);

        return $result;
    }

    /**
     * @param $email
     * @param array $formData
     *
     * @return mixed
     */
    public function postEmailSubscriptionRequest($email, array $formData)
    {
        $firstName = 'Subscriber';
        $lastName = \uniqid(\time());

        $data = [
            'label' => \sprintf('%s %s', $firstName, $lastName),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'conversion_amount' => 0.0,
            'service_target' => 'ANCAMARCUSFIT',
            'campaign_key' => 420222498,
            'data' => $formData,
        ];

        $encodedData = \json_encode($data);

        $ch = \curl_init('http://crm.epcvip.com/api/leads');
        \curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        \curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        \curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: '.\strlen($encodedData),
                'Authorization: Bearer 0a9fab36846de8eb1aaba3df017346c34996b93f',
            )
        );
        \curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        \curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = \curl_exec($ch);
        \curl_close($ch);

        return $result;
    }
}
