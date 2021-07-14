#!/bin/bash

wp user set-role dtovbein administrator
wp user delete nhazim@greenpeace.org --reassign=1 --yes
