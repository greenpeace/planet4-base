#!/bin/bash

# Set domains for the Preconnect Settings option
echo -e "https://in.hotjar.com\nhttps://act.greenpeace.org" > domains.txt
wp option patch insert planet4_options preconnect_domains < domains.txt
rm domains.txt
