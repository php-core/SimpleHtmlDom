#!/usr/bin/env bash

if [ ! -d venv ]; then
  python3 -m venv venv
fi

source venv/bin/activate
python3 -m pip install --upgrade pip
python3 -m pip install mkdocs mkdocs-redirects

mkdocs build

if [ -d docs-html ]; then
  rm -rf docs-html
fi

mv site docs-html
