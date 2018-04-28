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
    const ADD_BLOCK_METHOD_NAME = 'landing.landing.addblock';

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

    /**
     * Add new block with attribute $fields on the page $lid
     *
     * @param $lid
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
    public function addBlock($lid, array $fields){

        if(is_null($lid))
        {
            throw new Bitrix24Exception('lid id is null');
        }

        if(empty($fields))
        {
            throw new Bitrix24Exception('fields array is empty');
        }

        $fullResult = $this->client->call(
            self::ADD_BLOCK_METHOD_NAME,
            array(
                'lid' => $lid,
                'fields' => $fields,
            )
        );

        return $fullResult;
    }

    /**
     * Remove block with id = <$block> from the page $lid
     *
     * @param $lid
     * @param $block
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
    public function deleteBlock($lid, $block){

        if(is_null($lid))
        {
            throw new Bitrix24Exception('lid id is null');
        }

        if(is_null($block))
        {
            throw new Bitrix24Exception('block id is null');
        }

        $fullResult = $this->client->call(
            'landing.landing.deleteblock',
            array(
                'lid' => $lid,
                'block' => $block,
            )
        );

        return $fullResult;
    }

    /**
     * Add blocks to the page as batch
     *
     * @param array $blocks
     * @return array
     */
    public function batchAddBlocks (array $blocks){
        $fullResult = array(
            'result' => array(),
            'errors' => array()
        );
        foreach($blocks as $block){
            $this->client->addBatchCall(self::ADD_BLOCK_METHOD_NAME, $block, function($result) use (&$fullResult){
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