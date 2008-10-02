## Background

Photo Promenade aims to be an easy to install and use photo gallery script for PHP. Uploading the photos is done via FTP, but from there on the script takes over and automatically creates the navigation and thumbnails. The layout of the  gallery can be easily adjusted to one's needs via HTML, PHP and CSS.
Photo Promenade provides RSS and Photocast feeds for all and individual albums.

## Installation

1. Copy everything to your server.
2. Add albums by creating folders with photos in the `albums` folder.
3. Point your browser to Photo Promenade's `index.php` and it will list all albums and create thumbnails automatically.


## Configuration

You can adjust the default settings in `config.yml`.


### Thumbnail Sizes

To set the size of your thumbnails and previews, adjust the `sizes` parameter in the `config.yml` file. The default sizes used by Photo Promenade are called "big" and "thumb", but you can create more named sizes if you want to and use them with your own code.

Sizes can be specified using either width or height or both. The aspect ratios of the photos will always be kept intact.


### Layouts

Photo Promenade uses a simple templating system consisting of _layouts_ and _views_. The layout is the main HTML framework that wraps around the views.

The main layout can be found in `/layouts/layout.php`, but you can also overwrite this on a case-by-case basis by creating a file called `/layouts/<view>/layout.php`. E. g. if you want to include some background information about your photo site on the home page, create a new layout in `/layouts/index/layout.php`.

A standard installation of Photo Promenade comes with these three views:

* _Index_ is being used as the starting point, it lists all albums.
* _Album_ displays the thumbnails of an album with links to their bigger previews.
* _Error_ is displayed when a script error occured.

You can adjust these layouts as you wish.


### Album Info

When you visit a newly created album for the first time, an `info.yml` file is created for you in the albums' folder. Change the title there or enter a description that goes with the album.


## Contributors

* Peter Gassner, http://www.naehrstoff.ch
* Benjamin Wiederkehr, http://www.artillery.ch
* Carlo Joerges, http://www.minze.org
