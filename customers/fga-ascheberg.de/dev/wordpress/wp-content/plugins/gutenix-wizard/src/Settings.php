<?php


namespace zw;

class Settings
{

    /**
     * Manifest file content
     *
     * @var array
     */
    private $allSettings = null;

    /**
     * Manifest defaults
     *
     * @var array
     */
    private $defaults = null;

    /**
     * Get settings from array.
     *
     * @param array $settings Settings trail to get.
     * @return mixed
     */
    public function get($settings = array())
    {
        $allSettings = $this->getAllSettings();
        if (!$allSettings) {
            return false;
        }

        if (!is_array($settings)) {
            $settings = array($settings);
        }

        $count = count($settings);
        $result = $allSettings;

        for ($i = 0; $i < $count; $i++) {
            if (empty($result[$settings[$i]])) {
                return false;
            }

            $result = $result[$settings[$i]];
            if ($count - 1 === $i) {
                return $result;
            }
        }
    }

    /**
     * Get mainfest
     * @return mixed
     */
    public function getAllSettings()
    {
        if (null !== $this->allSettings) {
            return $this->allSettings;
        }
        $settings = array();
        $allSettings = array(
            'remap' => isset($settings['remap']) ? $settings['remap'] : $this->getDefaults('remap'),
            'import' => isset($settings['import']) ? $settings['import'] : $this->getDefaults('import'),
        );
        $this->allSettings = $allSettings;
        return $this->allSettings;
    }

    /**
     * Get wizard defaults
     *
     * @param string $part What part of manifest to get (optional - if empty return all)
     * @return array
     */
    public function getDefaults($part = null)
    {
        if (null === $this->defaults) {
            $import = array(
                'chunk_size' => 10,
                'regenerate_chunk_size' => 3,
                'allow_types' => false,
            );

            $remap = array(
                'post_meta' => array(),
                'term_meta' => array(),
                'options' => array(
                    'woocommerce_catalog_columns',
                    'woocommerce_catalog_rows',
                ),
            );

            $this->defaults = array(
                'remap' => $remap,
                'import' => $import,
            );
        }

        if (!$part) {
            return $this->defaults;
        }

        if (isset($this->defaults[$part])) {
            return $this->defaults[$part];
        }
        return array();
    }
}
