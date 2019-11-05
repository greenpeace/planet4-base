#!/bin/bash

excluded=(orghongkong orgkorea orgtaiwan orgslovakia orgeastasia ch)

nro="${APP_HOSTNAME##*.}${APP_HOSTPATH}"
echo "NRO: ${nro}"

for i in "${excluded[@]}"
do
    if [ "$i" == "$nro" ] ; then
        echo "Excluded NRO"
        exit
    fi
done

# Run wp cli command to convert shortcake shortcodes to gutenberg blocks.
wp cache flush
wp plugin activate --all
wp p4-gblocks convert_to_gutenberg --skip-plugins=sitepress-multilingual-cms,wpml-translation-management,wpml-string-translation,wpml-media-translation
wp plugin deactivate planet4-plugin-blocks
wp cache flush
