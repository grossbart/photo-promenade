## Background

Photo Promenade aims to be an easy to install and use photo gallery script for PHP. Uploading the photos is done via FTP, but from there on the script takes over and automatically creates the navigation and thumbnails. The layout of the  gallery can be easily adjusted to one's needs via HTML, PHP and CSS.


## Installation

1. Copy everything to your server.
2. Add albums by creating folders with photos in the `albums` folder.
3. Point your browser to Photo Promenade's `index.php` and it will list all albums and create thumbnails automatically.


## Configuration

You can adjust the default settings in `config.yml`.


### Thumbnail Sizes

To set the size of your thumbnails and previews, adjust the `sizes` parameter in the `config.yml` file.

The default sizes used by Photo Promenade are called "big" and "thumb", but you can create more named sizes if you want to and use them with your own code.


### Layouts

Photo Promenade uses three layouts: 

* _Index_ is being used as the starting point, it lists all albums.
* _Album_ displays the thumbnails of an album with links to their bigger previews.
* _Error_ is displayed when a script error occured.

You can adjust these layouts as you wish.


## Contributors

* Peter Gassner, http://www.naehrstoff.ch
* Benjamin Wiederkehr, http://www.artillery.ch
