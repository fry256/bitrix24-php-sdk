<?php
namespace Bitrix24\Landing;
use Bitrix24\Bitrix24Entity;
use Bitrix24\Exceptions\Bitrix24Exception;

/**
 * Class Site
 * @package Bitrix24\Landing
 */
class Site extends Bitrix24Entity
{
    /**
     * get list of created sites
     *
     * @param array $params work like getList params in Bitrix kernel D7
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
    public function getList(array $params)
    {

        $fullResult = $this->client->call(
            'landing.site.getList',
            array(
                'params' => $params
            )
        );
        return $fullResult;
    }


    /**
     * Add new site to system
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
            || (!isset($fields['DOMAIN_ID']) || strlen($fields['DOMAIN_ID']) === 0)
        )
        {
            throw new Bitrix24Exception('You have to fill all mandatory fields');
        }

        $fullResult = $this->client->call(
            'landing.site.add',
            array(
                'fields' => $fields
            )
        );
        return $fullResult;
    }
}