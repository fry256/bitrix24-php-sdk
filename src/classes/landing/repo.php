<?php
namespace Bitrix24\Landing;
use Bitrix24\Bitrix24Entity;
use Bitrix24\Exceptions\Bitrix24Exception;

/**
 * Class Repo
 * @package Bitrix24\Landing
 */
class Repo extends Bitrix24Entity
{
    const REGISTER_METHOD_NAME = 'landing.repo.register';

    /**
     * Register new block in repository
     *
     * @param $code
     * @param array $fields
     * @param array $manifest
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
    public function register($code, array $fields, array $manifest)
    {

        if(is_null($code))
        {
            throw new Bitrix24Exception('block code is null');
        }


        /*if(
            (!isset($fields['TITLE']) || strlen($fields['TITLE']) === 0)
            || (!isset($fields['CODE']) || strlen($fields['CODE']) === 0)
            || (!isset($fields['SITE_ID']) || intval($fields['SITE_ID']) === 0)
        )
        {
            throw new Bitrix24Exception('You have to fill all mandatory fields');
        }*/

        $fullResult = $this->client->call(
            self::REGISTER_METHOD_NAME,
            array(
                'code' => $code,
                'fields' => $fields,
                'manifest' => $manifest
            )
        );
        return $fullResult;
    }

    public function batchRegistration (array $blocks){
        $fullResult = array(
            'result' => array(),
            'errors' => array()
        );
        foreach($blocks as $block){
            $this->client->addBatchCall(self::REGISTER_METHOD_NAME, $block, function($result) use (&$response){
                if(isset($result['error']) && count($result['error']) > 0){
                    $fullResult['errors'][] = array(
                        'type' => '',
                        'message' => $result['error']['error_description']
                    );
                }else{
                    $fullResult['result'][] = $result['result'];
                }
            });
        }

        try {
            $this->client->processBatchCalls();
        }catch (\Exception $e){
            $fullResult['errors'][] = $e->getMessage();
        }

        return $fullResult;
    }
}