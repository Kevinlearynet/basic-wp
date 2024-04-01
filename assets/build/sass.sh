#!/bin/bash

sass --no-source-map --stop-on-error --trace --style compressed assets/scss/theme.scss assets/dist/theme.css;
echo "Successfully compiled assets/scss/theme.scss";

sass --no-source-map --stop-on-error --trace --style compressed assets/scss/admin.scss assets/dist/admin.css;
echo "Successfully compiled assets/scss/admin.scss";
