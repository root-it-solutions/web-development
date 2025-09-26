<?php

namespace zw\services;

use zw\helpers\File;
use zw\Plugin;
use zw\utils\FileCache;

class ImportContentService
{
    /**
     * @param null $skin
     * @param bool $isUploaded
     * @return bool|string|null
     * @throws \Exception
     */
    public function getImportFile($skin = null, $isUploaded = false)
    {
        $file = $this->getRemouteFile($skin);

        if ($file === null || !file_exists($file)) {
            return null;
        }
        return $file;
    }

    /**
     * Returns remote file
     * @param null $skin
     * @return bool|string|null
     * @throws \Exception
     */
    public function getRemouteFile($skin = null)
    {
        $cacheRootDid = File::normalizePath(ZW_ROOT . '/runtime/cache');
        File::createDirectory($cacheRootDid);
        $cacheId = 'skin-info-' . $skin;
        $cache = new FileCache(array(
            'name' => $cacheId,
            'path' => $cacheRootDid . DIRECTORY_SEPARATOR,
            'extension' => '.bin'
        ));
        $cache->eraseExpired();
        $skinInfo = $cache->retrieve($cacheId);
        if ($skinInfo === null) {
            $sService = new \zw\services\SkinService();
            $skinInfo = $sService->info($skin);
            if ($skinInfo !== null) {
                $cache->store($cacheId, $skinInfo, 900);
            }
        }

        if (!isset($skinInfo['full_xml']) || $skinInfo['full_xml'] === '') {
            return null;
        }

        $fileUrl = $skinInfo['full_xml'];
        $filename = $skin . '.xml';
        $basePath = Plugin::instance()->filesManager->base_path();
        File::createDirectory(File::normalizePath($basePath));

        $toPath = File::normalizePath($basePath . $filename);
        if (file_exists($toPath)) {
            return $toPath;
        }
        $tmpath = download_url(esc_url($fileUrl));
        if (!$tmpath) {
            return false;
        }

        if (!copy($tmpath, $toPath)) {
            return false;
        }
        if (file_exists($tmpath)) {
            unlink($tmpath);
        }

        return $toPath;
    }

    /**
     * Remap all required data after installation completed
     *
     * @return void
     */
    public function remapAll($importer = null)
    {
        new RemapCallbacks($importer);
        /**
         * Attach all posts remapping related callbacks to this hook
         *
         * @param array Posts remapping data. Format: old_id => new_id
         */
        if (\zw\utils\LocalStorage::get('importer.mapping.posts') !== null) {
            do_action('zw/import/remap-posts', \zw\utils\LocalStorage::get('importer.mapping.posts'));
        }

        /**
         * Attach all terms remapping related callbacks to this hook
         *
         * @param array Terms remapping data. Format: old_id => new_id
         */
        if (\zw\utils\LocalStorage::get('importer.mapping.term_id') !== null) {
            do_action('zw/import/remap-terms', \zw\utils\LocalStorage::get('importer.mapping.term_id'));
        }

        /**
         * Attach all comments remapping related callbacks to this hook
         *
         * @param array Comments remapping data. Format: old_id => new_id
         */
        if (\zw\utils\LocalStorage::get('importer.mapping.comments') !== null) {
            do_action('zw/import/remap-comments', \zw\utils\LocalStorage::get('importer.mapping.comments'));
        }

        /**
         * Attach all posts_meta remapping related callbacks to this hook
         *
         * @param array posts_meta data. Format: new_id => related keys array
         */
        if (\zw\utils\LocalStorage::get('importer.requires_remapping.posts_meta') !== null) {
            do_action('zw/import/remap-posts-meta', \zw\utils\LocalStorage::get('importer.requires_remapping.posts_meta'));
        }

        /**
         * Attach all terms meta remapping related callbacks to this hook
         *
         * @param array terms meta data. Format: new_id => related keys array
         */
        if (\zw\utils\LocalStorage::get('importer.requires_remapping.terms_meta') !== null) {
            do_action('zw/import/remap-terms-meta', \zw\utils\LocalStorage::get('importer.requires_remapping.terms_meta'));
        }
    }
}