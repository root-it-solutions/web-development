#!/bin/bash
for file in $(ls *.php);
do
    sed 's/<?=/<? echo /g' $file | sed 's/<?/<?php /g' > myTemp.php;
    mv myTemp.php $file;
    #echo "$file";
done

