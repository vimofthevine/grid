# Grid

A tabular data presentation tool.

## Quick Start

    $grid = new Grid;
    $grid->link()->action('entries/add')->text('Add New Entry');
    $grid->column()->field('id')->title('Entry ID');
    $grid->column()->field('title')->title('Entry Title');
    $grid->column('date')->title('Creation Date');
    $grid->column('action')->title('Edit')->action('entries/edit')->text('edit');
    $grid->data($dataset);
    echo $grid;

## Setting up a Grid

There are 5 steps for creating a grid.

1. Instantiate a grid object
1. Specify action links (if any)
1. Specify columns
1. Add data
1. Render the grid

### Specifying Action Links

The grid library allows for links to be printed at the top and bottom
of a grid table.  Typical usage includes "add a new entry" and "edit
the selected" links.

Links are specified by the Grid Library's `link()` method, which returns
a link object.  The argument of the `link()` method specifies the type of
link, either text (default), button, or submit.  Attributes of a link
object are specified by calling a function by the name of the attribute,
passing the value as an argument.

All links have the following attributes:

action
: the path (or route) for the link
text
: the text to display for the link

#### Text Link
    $grid->link()->action('controller/method')->text('Link Text');
    // OR
    $grid->link('text')->action('controller/method')->text('Link Text');

Will produce
    <a href="http://www.domain.com/controller/method">Link Text</a>

#### Button Link
    $grid->link('button')->action('controller/method')->text('Link Button');

Will produce
    <a href="http://www.domain.com/controller/method"><button>Link Button</button></a>

#### Submit Link
    $grid->link('submit')->action('controller/method')->text('Link Submit');

Will produce
    <input type="submit" value="Link Submit" />

### Specifying Columns

The grid library allows for columns to be defined.  The columns specify
what fields from each dataset record will be printed, and how it will
be printed.

Columns are specified by the Grid Library's `column()` method, which
returns a column object.  The argument of the `column()` method specifies
the type of column (default is `text`).  Attributes of a column object are specified by calling
a function by the name of the attribute, passing the value as an
argument.

All columns have the following attributes:

field
: the field of the dataset record to print
title
: the column heading

#### Text Column
    $grid->column()->title('Name')->field('name');
    // OR
    $grid->column('text')->title('Name')->field('name');

Will produce
    <tr>
        ...
        <th>Name</th>
        ...
    </tr>
    <tr>
        ...
        <td><?php echo $record->name; ?></td>
        ...
    </tr>

Additional attributes include:

callback
: a callback function to execute prior to printing
member
: if `field` represents an object, use the member variable of the object

For example,
    $grid->column()->title('Author')->field('author')->member('name');

Will produce
    <td><?php echo $record->$field->member; ?></td>

#### Date Column
    $grid->column('date')->title('Created')->field('created');

Extends text columns to pass the value of `$record->$field` through
the PHP `date()` function.

Additional attributes include:

format
: a PHP date format string to use as the first parameter for `date()`

The `field` attribute defaults to "date".

#### Action Column
    $grid->column('action')->title('Details')->action('controller/method')->field('id')->text('view');

Will produce
    <tr>
        ...
        <th>Details</th>
        ...
    </tr>
    <tr>
        ...
        <td><a href="http://www.domain.com/controller/method/<?php echo $record->field; ?>">view</a></td>
        ...
    </tr>

Additional attributes include:
action
: url (or route) to use as the link target
text
: the text to use for the link
img
: an image to use instead of text (text is used as alt attribute)

Note:
The field attribute defaults to "id", and the value of the field is
appended to the end of the `action` url.

#### Radio Column
    $grid->column('radio')->title('Edit')->field('id')->name('to_edit');

Will produce
    <tr>
        ...
        <th>Edit</th>
        ...
    </tr>
    <tr>
        ...
        <td><input type="radio" name="to_edit" value="<?php echo $record->$field; ?>" /></td>
        ...
    </tr>

Additional attributes include:
name
: the input name for the radio column

The `field` attribute defaults to "id".

### Specifying Data

The grid library allows for data to be added with the `data()` method.
The argument to the `data()` method is expected to be an iteratable
collection of data records.

For example:
    $users = Sprig::factory('user')->load(null, FALSE);
    $grid->data($users);

The `data()` function can be called multiple times to add more dataset
records to the grid dataset.

## Customizing the Grid

To create a new column type, create a new class and place it in
    APPPATH.'/classes/grid/column/newtype.php'

The new column class must extend `Grid_Column` to take advantage of the
member variable set functions (via the magic `__call()` function).  If
a new variable is going to be used, specify it as a public member of the
column class.

The custom column class must implement the public function `render($data)`.
This function can perform any data manipulation necessary and return a
string (which will be placed between <td></td>).

For example:
    <?php
    class Grid_Column_Hash extends Grid_Column {
        public $salt = '';
        public $hash = 'md5';

        public function render($data) {
            $data = (object) $data;
            $text = $data->{$this->field};
            return hash($this->$hash, $salt.$text);
        }
    }

    $grid->column('hash')->title('Hash')->field('password')->salt('somesalt');

