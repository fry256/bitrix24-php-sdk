<?php
namespace Bitrix24\Landing;
use Bitrix24\Bitrix24Entity;
use Bitrix24\Exceptions\Bitrix24Exception;

/**
 * Class Landing
 * @package Bitrix24\Landing
 */
class Landing extends Bitrix24Entity
{
    /**
     * Add new page to system
     *
     * @param array $fields
     * @return array
     * @throws Bitrix24Exception
     * @throws \Bitrix24\Exceptions\Bitrix24ApiException
     * @throws \Bitrix24\Exceptions\Bitrix24EmptyResponseException
     * @throws \Bitrix24\Exceptions\Bitrix24IoException
     * @throws \Bitrix24\Exceptions\Bitrix24MethodNotFoundException
     * @throws \Bitrix24\Exceptions\Bitrix24PaymentRequiredException
     * @throws \Bitrix24\Exceptions\Bitrix24PortalDeletedException
     * @throws \Bitrix24\Exceptions\Bitrix24PortalRenamedException
     * @throws \Bitrix24\Exceptions\Bitrix24SecurityException
     * @throws \Bitrix24\Exceptions\Bitrix24TokenIsExpiredException
     * @throws \Bitrix24\Exceptions\Bitrix24TokenIsInvalidException
     * @throws \Bitrix24\Exceptions\Bitrix24WrongClientException
     */
    public function add(array $fields)
    {

        if(
            (!isset($fields['TITLE']) || strlen($fields['TITLE']) === 0)
            || (!isset($fields['CODE']) || strlen($fields['CODE']) === 0)
            || (!isset($fields['SITE_ID']) || intval($fields['SITE_ID']) === 0)
        )
        {
            throw new Bitrix24Exception('You have to fill all mandatory fields');
        }

        $fullResult = $this->client->call(
            'landing.landing.add',
            array(
                'fields' => $fields
            )
        );
        return $fullResult;
    }
}