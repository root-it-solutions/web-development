<?php


namespace zw\services;


class Widgets
{
    /**
     * Returns available widgets data.
     * @return mixed
     */
    public static function availableWidgets()
    {
        global $wp_registered_widget_controls;
        $widgetControls = $wp_registered_widget_controls;
        $availableWidgets = array();
        foreach ($widgetControls as $widget) {
            $idBase = isset($widget['id_base']) ? $widget['id_base'] : null;
            if (!empty($idBase) && !isset($availableWidgets[$idBase])) {
                $availableWidgets[$idBase]['id_base'] = $idBase;
                $availableWidgets[$idBase]['name'] = $widget['name'];
            }
        }
        return apply_filters('zw/tools/widgets/available-widgets', $availableWidgets);
    }
}