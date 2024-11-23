<?php
    $myContent_class = new ContentClass;
    $myMenu_class = new MenuClass;

    $myMenu_class->getMenuByUrlName($_REQUEST["one"]);
    $myContent_class->getContentById($myMenu_class->content_id);

    $siteTitle = $myContent_class->title;

    $myList_class = new ListClass;
    $myListEntries_class = new ListEntryClass;

    $myList_class->getListById(1);

    $listEntries_tpl = '';

    foreach($myListEntries_class->getEntriesByListId($myList_class->id) as $Entry)
    {
        $Entry->text = str_replace(array('<p>', '</p>'), array('', ''), $Entry->text);
        $te->assign($Entry, '');

        if(0 < $Entry->image_id)
        {
            $myImage_class = new ImageClass;
            $myImage_class->getImageById($Entry->image_id);
            $te->assign('image', $myImage_class->nameFile);
        }
        else
        {
            $te->assign('imgClass', 'class="noImage"');
        }

        $listEntries_tpl .= $te->display($GLOBALS["referenceListItemTemplate"]);
    }

    $te->assign('referenceList', $listEntries_tpl);
    $list_tpl= $te->display($GLOBALS["referenceTemplate"]);

    $te->assign('title', $myContent_class->title);
    $te->assign('content', $list_tpl);
    $content = $te->display($GLOBALS[$myMenu_class->getTemplate()."Template"]);
    $te->assign('motive_id', 'noimage');
?>
