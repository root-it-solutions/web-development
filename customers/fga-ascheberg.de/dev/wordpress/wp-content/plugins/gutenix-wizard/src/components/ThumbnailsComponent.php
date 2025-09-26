<?php


namespace zw\components;


use zw\helpers\StringHelper;

class ThumbnailsComponent
{
    const PREFIX = 'thumbnails';
    const CHUNK_SIZE = 3;

    public function __construct()
    {
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/info', array($this, 'actionInfo'));
        add_action('wp_ajax_' . \zw\Plugin::PREFIX . '-api/v1/' . self::PREFIX . '/chunk-import', array($this, 'actionChunkImport'));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function actionInfo()
    {
        $skin = isset($_REQUEST['skin']) ? $_REQUEST['skin'] : null;
        if (empty($skin) || StringHelper::clean($skin) === '') {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                esc_html__('Bad Params', 'zw'),
                array('status' => 503)));
        }

        $count = wp_count_attachments();
        $count = (array)$count;
        $totalCount = 0;

        foreach ($count as $mime => $num) {
            if (false === strpos($mime, 'image')) {
                continue;
            }
            $totalCount += (int)$num;
        }
        $chunksCount = ceil((int)$totalCount / self::CHUNK_SIZE);
        return apply_filters('zw/jsonResponse', array(
            'total' => $totalCount,
            'chunksCount' => $chunksCount,
            'chunkSize' => self::CHUNK_SIZE,
        ));
    }

    /**
     * @return mixed
     */
    public function actionChunkImport()
    {
        $chunkIndex = isset($_REQUEST['chunkIndex']) ? $_REQUEST['chunkIndex'] : null;
        if ($chunkIndex == null || StringHelper::clean($chunkIndex) === '') {
            return apply_filters('zw/jsonResponse', new \WP_Error(
                self::PREFIX . '/error',
                esc_html__('Bad Params', 'zw'),
                array('status' => 503)));
        }

        $offset = self::CHUNK_SIZE * $chunkIndex;
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'numberposts' => self::CHUNK_SIZE,
            'offset' => $offset,
        ));

        if (is_array($attachments) && count($attachments) > 0) {
            foreach ($attachments as $attachment) {
                $id = $attachment->ID;
                $file = get_attached_file($id);
                $metadata = wp_generate_attachment_metadata($id, $file);
                wp_update_attachment_metadata($id, $metadata);
            }
        }
        return apply_filters('zw/jsonResponse', array(
            'message' => 'generated',
        ));
    }
}