#!/bin/bash

(
cd _ext
rm -rf tk.phpautodoc
hg clone https://bitbucket.org/tk0miya/tk.phpautodoc
rm -rf tk.phpautodoc/.hg

rm -rf phpdomain
hg clone https://bitbucket.org/birkenfeld/sphinx-contrib
mv sphinx-contrib/phpdomain/ .
rm -rf sphinx-contrib
) || exit 1;

(
cd _themes
rm -rf sphinx_rtd_theme
git clone git@github.com:snide/sphinx_rtd_theme.git sphinx_rtd_theme_dist
mv sphinx_rtd_theme_dist/sphinx_rtd_theme .
rm -rf sphinx_rtd_theme_dist
) || exit 1
