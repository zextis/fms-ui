# FMS-App Repository

PHP application for Fleet Management System

## Purpose

Enable users to view and submit vehicle requests and administrators to manage drivers, requests and vehicles.

## Features

- simple but clean structure
- makes "beautiful" clean URLs
- CRUD actions: Create, Read, Update and Delete database entries easily
- tries to follow PSR coding guidelines
- uses PDO for any database requests, comes with an additional PDO debug tool to emulate your SQL statements
- uses only native PHP code, so people don't have to learn a framework
- uses PSR-4 autoloader

## Requirements

- PHP 5.6 or PHP 7.0
- MySQL
- mod_rewrite activated

## URL/Routes structure

Actions Handled By Resource Controller
Structure for URL:   controller/action/parameters

Examples:
GET               /users/index
GET               /users/create
POST              /users/store
GET               /users/show/{id}
GET               /users/edit/{id}
POST(PUT/PATCH)   /users/update/{id}
POST(DELETE)      /users/delete/{id}

Functions in controller:
index - main function/landing view
create - route show data form
store - store from create record
show - show record passing the {id} as parameter
edit - route edit record  passing the {id} as parameter
update - update from edit form  passing the {id} as parameter
delete - delete  passing the {id} as parameter

## Quick-Start

### The structure in general

The application's URL-path translates directly to the controllers (=files) and their methods inside
application/controllers.

`example.com/home/exampleOne` will do what the *exampleOne()* method in application/Controller/HomeController.php says.

`example.com/home` will do what the *index()* method in application/Controller/HomeController.php says.

`example.com` will do what the *index()* method in application/Controller/HomeController.php says (default fallback).

`example.com/songs` will do what the *index()* method in application/Controller/SongsController.php says.

`example.com/songs/edit/17` will do what the *editsong()* method in application/Controller/SongsController.php says and
will pass `17` as a parameter to it.

Self-explaining, right ?

### Showing a view

Let's look at the exampleOne()-method in the home-controller (application/Controller/HomeController.php): This simply shows
the header, footer and the example_one.php page (in views/home/). By intention as simple and native as possible.

```php
public function exampleOne()
{
    // load view
    $this->View->render('home/index');
}
```

The statement `$this->View->render('home/index');` will check the path (application/view/home/index.php) to load the file index.php in the folder.

### Working with data

Let's look into the index()-method in the songs-controller (application/Controller/SongsController.php): Similar to exampleOne,
but here we also request data. Again, everything is extremely reduced and simple: $Song->getAllSongs() simply
calls the getAllSongs()-method in application/Model/Song.php (when $Song = new Song()).

```php
namespace Mini\Controller

use Mini\Core\Controller;
use Mini\Core\Redirect;
use Mini\Core\Request;
use Mini\Core\Auth;
use Mini\Model\Song;

class SongsController extends Controller
{
    public function index()
    {
        // Instance new Model (Song)
        $Song = new Song();
        // getting all songs and amount of songs
        $songs = $Song->getAllSongs();
        $amount_of_songs = $Song->getAmountOfSongs();

        // load view. within the view files we can echo out $songs and $amount_of_songs easily
        $this->View->render('home/index', array('songs' => $songs, 'amount_of_songs' => $amount_of_songs));
    }
}
```

For extreme simplicity, data-handling methods are in application/model/ClassName.php. Have a look how getAllSongs() in model.php looks like: Pure and
super-simple PDO.

```php
namespace Mini\Model

use Mini\Core\Model;

class Song extends Model
{
    public function getAllSongs()
    {
        $sql = "SELECT id, artist, track, link FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}
```

The result, here $songs, can then easily be used directly
inside the view files (in this case application/views/songs/index.php, in a simplified example):

```php
<tbody>
<?php foreach ($this->songs as $song) { ?>
    <tr>
        <td><?php if (isset($song->artist)) echo htmlspecialchars($song->artist, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php if (isset($song->track)) echo htmlspecialchars($song->track, ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>
<?php } ?>
</tbody>
```
