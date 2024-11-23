<?php
    $myContent_class = new ContentClass;
    $myMenu_class = new MenuClass;

    $myMenu_class->getMenuByUrlName($_REQUEST["two"]);
    $myContent_class->getContentById($myMenu_class->content_id);

    $siteTitle = $myContent_class->title;
    $te->assign('title', $myContent_class->title);

    $te->assign('sitemap', getSitemapContent('0', 'de'));
    $te->assign('content', $te->display($GLOBALS["sitemapTemplate"]));
    $content = $te->display($GLOBALS[$myMenu_class->getTemplate()."Template"]);

    function getSitemapContent($parent_id, $myLang = 'de', $parentUrl = '')
    {
        $myMenu_class = new MenuClass;
        $myMenu_array = $myMenu_class->getMenuByParentIdF($parent_id, $myLang);
        $myMenu_count = count($myMenu_array);

        $content_tmp = '';

        for($i = 0; $i < $myMenu_count; $i++)
        {
            $myChildsTE = new TemplateEngine;
            $myChildsTE->assign("imagesdir",IMAGESDIR);
            $myChildsTE->assign("cssdir",CSSDIR);
            $myChildsTE->assign("jsdir",JSDIR);
            $myChildsTE->assign($myMenu_array[$i], '');
            if($parentUrl !== '')
            {
                $myMenu_array[$i]->urlName = $parentUrl.'/'.$myMenu_array[$i]->urlName;
                $myChildsTE->assign('urlName', $myMenu_array[$i]->urlName);
            }
            $content_tmp .= $myChildsTE->display($GLOBALS["sitemapListItemTemplate"]);
            if($myMenu_array[$i]->checkForchilds())
            {
                $content_tmp = substr($content_tmp, 0, -6);
                $content_tmp .= '<ul>';
                $content_tmp .= getsitemapContent($myMenu_array[$i]->id, $myLang, $myMenu_array[$i]->urlName);
                $content_tmp .= '</ul></li>';
            }
        }
        return $content_tmp;
    }
?>
