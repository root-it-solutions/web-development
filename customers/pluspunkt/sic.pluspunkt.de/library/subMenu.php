<?php
    $myTE = new TemplateEngine;
    $myMenu_class = new MenuClass;
    $mySubMenu_class = new ContentClass;

    $myMenu_class->getMenuByUrl($urlOne);

    $subMenu_tmp = '';
    foreach($mySubMenu_class->getContentChilds($myMenu_class->id, 0) as $SubMenu)
    {
        $mySubTE = new TemplateEngine;

        if(preg_match('/http:\/\//', $SubMenu->linkName))
        {
            $mySubTE->assign('url', $SubMenu->linkName);
        }
        else
        {
            $mySubTE->assign('url', '/'.$myMenu_class->url.'/'.$SubMenu->linkName.'.html');
        }
        $mySubTE->assign('title', $SubMenu->title);
        $mySubTE->assign('linkName', $SubMenu->linkName);
        if($urlTwo == $SubMenu->linkName)
        {
            $mySubTE->assign('onSite', 'class="onSite"');
        }
        else
        {
            $mySubTE->assign('oneSite', '');
        }
        $subMenu_tmp .= $mySubTE->display($GLOBALS["subMenuListItemTemplate"]);
    }

    $myTE->assign('title', $myMenu_class->name);
    $myTE->assign('subMenuList', $subMenu_tmp);
    echo $myTE->display($GLOBALS["subMenuTemplate"]);
?>
