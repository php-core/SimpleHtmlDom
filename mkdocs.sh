#!/usr/bin/env bash

if [ ! -f venv ]; then
  python3 -m venv venv
fi

source venv/bin/activate
python3 -m pip install --upgrade pip
python3 -m pip install mkdocs mkdocs-redirects

mkdocs build
mv site docs-html
