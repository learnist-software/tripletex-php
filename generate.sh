#!/bin/bash

set -x
set -e
set -u

root=$(dirname $0)

(cd $root &&

docker run --rm -v "${PWD}:/local" \
    -u "$(id -u):$(id -g)" \
    openapitools/openapi-generator-cli generate \
    -i /local/tripletex-api.json \
    -g php \
    -o /local/ \
    --invoker-package=Learnist\\Tripletex \
    --additional-properties=composerPackageName=learnist/tripletex \
    --artifact-version=1.0.0

)

