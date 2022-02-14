#!/bin/bash

# The new Action page, added a new rewrite rule which need to update existing permalink structure.
echo "Update the permalink structure"
wp rewrite flush
