#!/bin/bash

rm -fr ./media-element/dist/
mkdir -p ./media-element/dist/
cp -R ./node_modules/mediaelement/build/ ./media-element/dist/

# Remove Demo 
rm -f ./media-element/dist/demo.js
rm -f ./media-element/dist/demo.min.js
rm -f ./media-element/dist/english_chapters.vtt
rm -f ./media-element/dist/english.vtt
rm -f ./media-element/dist/favicon.ico
rm -f ./media-element/dist/german_chapters.vtt
rm -f ./media-element/dist/german.vtt
rm -f ./media-element/dist/index.html

# Remove non mimified js / css
rm -f ./media-element/dist/mediaelement-and-player.js
rm -f ./media-element/dist/mediaelement.js
rm -f ./media-element/dist/mediaelementplayer-legacy.css
rm -f ./media-element/dist/mediaelementplayer.css

# Remove non mimified renderers
rm -f ./media-element/dist/renderers/dailymotion.js
rm -f ./media-element/dist/renderers/facebook.js
rm -f ./media-element/dist/renderers/soundcloud.js
rm -f ./media-element/dist/renderers/twitch.js
rm -f ./media-element/dist/renderers/vimeo.js
rm -f ./media-element/dist/renderers/youtube.js

npx postcss media-element/mediaelement.css > media-element/mediaelement.min.css
./node_modules/esbuild/bin/esbuild media-element/mediaelement.js --outfile=media-element/mediaelement.min.js --minify