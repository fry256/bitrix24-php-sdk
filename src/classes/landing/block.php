<?php
namespace Bitrix24\Landing;
use Bitrix24\Bitrix24Entity;
use Bitrix24\Exceptions\Bitrix24Exception;

/**
 * Class Block
 * @package Bitrix24\Landing
 */
class Block extends Bitrix24Entity
{
    /**
     * get  block Manifest
     *
     * @param integer $lid
     * @param integer $block
     * @param integer $editMode
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
    public function getManifest($lid, $block, $editMode)
    {
        $editMode = ($editMode === 1 ? 1 : 0);

        if(is_null($lid))
        {
            throw new Bitrix24Exception('lid id is null');
        }

        if(is_null($block))
        {
            throw new Bitrix24Exception('block id is null');
        }

        $fullResult = $this->client->call(
            'landing.block.getmanifest',
            array(
                'lid' => $lid,
                'block' => $block,
                'params' => array('edit_mode' => $editMode)
            )
        );
        return $fullResult;
    }

    /**
     * get block source
     *
     * @param integer $lid
     * @param integer $block
     * @param integer $editMode
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
    public function getContent($lid, $block, $editMode)
    {
        $editMode = ($editMode === 1 ? 1 : 0);

        if(is_null($lid))
        {
            throw new Bitrix24Exception('lid id is null');
        }

        if(is_null($block))
        {
            throw new Bitrix24Exception('block id is null');
        }
        $fullResult = $this->client->call(
            'landing.block.getcontent',
            array(
                'lid' => $lid,
                'block' => $block,
                'editMode' => $editMode
            )
        );
        return $fullResult;
    }

    /**
     * Update HTML content for block
     *
     * @param $lid
     * @param $block
     * @param $content
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
    public function updateContent($lid, $block, $content){

        if(is_null($lid))
        {
            throw new Bitrix24Exception('lid id is null');
        }

        if(is_null($block))
        {
            throw new Bitrix24Exception('block id is null');
        }

        if(is_null($content) || strlen($content) === '')
        {
            throw new Bitrix24Exception('There is no content to update');
        }

        $fullResult = $this->client->call(
            'landing.block.updatecontent',
            array(
                'lid' => $lid,
                'block' => $block,
                'content' => $content
            )
        );

        return $fullResult;
    }

    /**
     * Method for update block attributes
     *
     * @param $lid
     * @param $block
     * @param array $attrs
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
    public function updateAttrs($lid, $block, array $attrs){

        if(is_null($lid))
        {
            throw new Bitrix24Exception('lid id is null');
        }

        if(is_null($block))
        {
            throw new Bitrix24Exception('block id is null');
        }

        if(empty($attrs))
        {
            throw new Bitrix24Exception('There is no attributes to update');
        }

        $fullResult = $this->client->call(
            'landing.block.updateattrs',
            array(
                'lid' => $lid,
                'block' => $block,
                'data' => $attrs
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
            'landing.block.addblock',
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
            'landing.block.deleteblock',
            array(
                'lid' => $lid,
                'block' => $block,
            )
        );

        return $fullResult;
    }

}