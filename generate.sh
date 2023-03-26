#!/bin/bash

set -x
set -e
set -u

root=$(dirname $0)


java -Xms2G -jar ./swagger-codegen-cli.jar  generate \
      -i tripletex-api.json \
      -l php \
      -o . \
      --invoker-package=Learnist\\Tripletex \
      --additional-properties=composerPackageName=learnist-software/tripletex-php \
      --artifact-version=1.0.0 --remove-operation-id-prefix=true \
      --git-user-id=learnist-software \
      --git-repo-id=tripletex-php  \
      --additional-properties=packagePath=. \
      -t ./template


